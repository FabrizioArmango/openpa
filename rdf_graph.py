import urllib.request
import json
from dicttoxml import dicttoxml
import xml.etree.ElementTree as ET
from rdflib import Graph, Literal, Namespace, URIRef
from rdflib.namespace import RDF, RDFS, FOAF, OWL, XSD, DC, DCTERMS
import requests

API_URL = "http://palermo.linked-data.eu/php/PalermoAbout2.php";
def urify(ns, testo):
    testo=testo.replace(" ","_").replace(".","")
    return ns+urllib.parse.quote(testo)
    
tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=churches'))
churchXML = tree.getroot()

tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=theatres'))
theatreXML = tree.getroot()

tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=typicalfoods'))
foodXML = tree.getroot()

placeList= ["cinema", "pub", "cocktailbar", "winebar", "streetfood", "restaurant", "disco"]
placeXML = {}
for place in placeList:
    tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=' + place + 's'))
    placeXML[place] = tree.getroot()


g = Graph()

# Define Namespaces
dbo = Namespace("http://dbpedia.org/ontology/")
dbp = Namespace("http://dbpedia.org/property/")
cpo = Namespace("http://www.comune.palermo.it/ontology/")
geo = Namespace("http://www.w3.org/2003/01/geo/wgs84_pos#")
pldo = Namespace("http://palermo.linked-data.eu/ontology/")
####### ->
# Namespace Bindings
g.bind("dbo", dbo)
g.bind("dbp", dbp)
g.bind("cpo", cpo)
g.bind("geo", geo)

#added to avoid output ns1
g.bind("owl", OWL)
g.bind("pldo", pldo)
####### ->


# FOOD
for data_record in foodXML:
    foodName = data_record.find("NAME")
    print(foodName.find("en").text)
    foodURI = urify("http://dbpedia.org/resource/", foodName.find("en").text)
    gs = g.resource(foodURI)
    gs.set(RDF.type, pldo.Food)

    for name in foodName:
        gs.add(pldo.nome, Literal(name.text, lang=name.tag))

    #gs.set(pldo.immagine, URIRef(data_record.find("IMAGE").text))

    dbPediaFoodURI = urify("http://dbpedia.org/resource/", foodName.find("en").text)
    gs.set(OWL.sameAs, URIRef(dbPediaFoodURI))

    #SETTARE I pldo.vicinoA


# CHURCHES
for data_record in churchXML:
    churchName = data_record.find("NAME")
    print(churchName.find("en").text)
    churchURI = urify("http://dbpedia.org/resource/", churchName.find("en").text)
    gs = g.resource(churchURI)
    gs.set(RDF.type, pldo.Chiesa)

    for name in churchName:
        gs.add(pldo.nome, Literal(name.text, lang=name.tag))

    #gs.set(pldo.immagine, URIRef(data_record.find("IMAGE").text))
    location = data_record.find("LOCATION")
    if location.find("LAT") is not None:
        if location.find("LNG") is not None:
            lat = location.find("LAT").text
            lng = location.find("LNG").text
            nearByChurchURI = "http://palermo.linked-data.eu:3000/?lat="+lat+"&lng="+lng
            result = requests.get(nearByChurchURI).json()
            for data in result:
                gs.add(pldo.vicinoA, URIRef(data))

    dbPediaChurchURI = urify("http://dbpedia.org/resource/", churchName.find("en").text)
    gs.set(OWL.sameAs, URIRef(dbPediaChurchURI))

    #SETTARE I pldo.vicinoA
# 

for place in placeList:
    for data_record in placeXML[place]:
        placeName = data_record.find("NAME").text
        print(placeName)
        placeURI = urify("http://palermo.linked-data.eu/resource/" + place + "s/", placeName)    
        gs = g.resource(placeURI)
        gs.set(RDF.type, pldo[place.capitalize()])
        gs.set(pldo.nome, Literal(placeName, lang='it'))
        placeURI_PA = urify("http://www.comune.palermo.it/resource/" + place + "s/", placeName)
        gs.set(OWL.sameAs, URIRef(placeURI_PA))
        

        if data_record.find("WEBSITE") is not None:
            gs.set(dbp.website, URIRef(data_record.find("WEBSITE").text))
        
        if data_record.find("EMAIL") is not None:
            gs.set(dbp.email, Literal(data_record.find("EMAIL").text))
        
        if data_record.find("LOCATION") is not None:
            location = data_record.find("LOCATION") 

            #dbp.location si accolla il nostro luogo?
            if location.find("ADDRESS")  is not None:              
                gs.set(dbp.location, Literal(location.find("ADDRESS").text))

            #dbp.city si accolla il nostro luogo?
            if location.find("CITY")  is not None:
                gs.set(dbp.city, Literal(location.find("CITY").text))

            #geo.lat si accolla il nostro luogo?
            if location.find("LAT") is not None:
                gs.set(geo.lat, Literal(location.find("LAT").text, datatype=XSD.decimal))
                
                if location.find("LNG") is not None:
                    gs.set(geo.lng, Literal(location.find("LNG").text, datatype=XSD.decimal))
                    lat = location.find("LAT").text
                    lng = location.find("LNG").text
                    nearByPlaceURI = "http://palermo.linked-data.eu:3000/?lat="+lat+"&lng="+lng
                    result = requests.get(nearByPlaceURI).json()
                    for data in result:
                        gs.add(pldo.vicinoA, URIRef(data))

# THEATRES
for data_record in theatreXML:
    theatreName = data_record.find("NAME").text
    print(theatreName)
    theatreURI = urify("http://www.comune.palermo.it/resource/theatres/", theatreName)
    gs = g.resource(theatreURI)
    gs.set(RDF.type, pldo.Teatro)

    gs.set(pldo.nome, Literal(theatreName, lang='it'))
    gs.set(pldo.posti, Literal(data_record.find("SEATS").text, datatype=XSD.nonNegativeInteger))


    if data_record.find("LOCATION") is not None:
        location = data_record.find("LOCATION") 

        if location.find("ADDRESS")  is not None:              
            gs.set(dbp.location, Literal(location.find("ADDRESS").text))

        if location.find("LAT") is not None:
            gs.set(geo.lat, Literal(location.find("LAT").text, datatype=XSD.decimal))
            
            if location.find("LNG") is not None:
                gs.set(geo.lng, Literal(location.find("LNG").text, datatype=XSD.decimal))        
                lat = location.find("LAT").text
                lng = location.find("LNG").text
                nearByTheatresURI = "http://palermo.linked-data.eu:3000/?lat="+lat+"&lng="+lng
                result = requests.get(nearByTheatresURI).json()
                for data in result:
                    gs.add(pldo.vicinoA, URIRef(data))

    #SETTARE I pldo.vicinoA


OUTPUT_PATH = 'grafo.ttl'
g.serialize(destination=OUTPUT_PATH, format='turtle')
