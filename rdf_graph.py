import urllib.request
import json
from dicttoxml import dicttoxml
import xml.etree.ElementTree as ET
from rdflib import Graph, Literal, Namespace, URIRef
from rdflib.namespace import RDF, RDFS, FOAF, OWL, XSD, DC, DCTERMS

API_URL = "";
def urify(ns, testo):
    testo=testo.replace(" ","_").replace(".","")
    return ns+urllib.parse.quote(testo)
    
tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=churches'))
churchXML = tree.getroot()

tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=theatres'))
theatreXML = tree.getroot()

tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=typicalfoods'))
foodXML = tree.getroot()

placeList= [“cinema”, “pub”, “cocktailbar”, “winebar”, “streetfood”, “restaurant”, “disco”]
placeXML = ()
for place in placeList:
tree = ET.parse(urllib.request.urlopen(API_URL + '?listOf=’ + place + ‘s’))
placeXML= tree.getroot()


g = Graph()

# Define Namespaces
dbo = Namespace("http://dbpedia.org/ontology/")
dbp = Namespace("http://dbpedia.org/property/")
cpo = Namespace("http://www.comune.palermo.it/ontology/")
geo = Namespace("http://www.w3.org/2003/01/geo/wgs84_pos#")

pldo = Namespace("http://palermo.linked-data.eu/ontology")
####### ->
# Namespace Bindings
g.bind("dbo", dbo)
g.bind("dbp", dbp)
g.bind("cpo", cpo)
g.bind("geo", geo)

g.bind("pldo", pldo)
####### ->



# CHURCHES
for data_record in churchXML:
    churchName = data_record.find("NAME")
    print(churchName.find("en").text)
    churchURI = urify("http://dbpedia.org/resource/", churchName.find("en").text)
    gs = g.resource(churchURI)
    gs.set(RDF.type, cpo.Church)

    for name in churchName:
        gs.add(cpo.name, Literal(name.text, lang=name.tag))

    gs.set(cpo.image, URIRef(data_record.find("IMAGE").text))

    location = data_record.find("LOCATION")    
    gs.set(geo.lat, Literal(location.find("LAT").text, datatype=XSD.decimal))
    gs.set(geo.lng, Literal(location.find("LNG").text, datatype=XSD.decimal))

# 

for place in placeList:
    for data_record in placeXML:
        placeName = data_record.find("NAME").text
        print(placeName)
        placeURI = urify("http://elsinor.linked-data.eu/resource/" + place + "s/", placeName)    
        gs = g.resource(placeURI)
        gs.set(RDF.type, pldo.Cinema)
        gs.set(cpo.name, Literal(cinemaName, lang='it'))
        cinemaURI_PA = urify("http://www.comune.palermo.it/resource/" + place + "s/", placeName)
        gs.set(OWL.sameAs, URIRef(cinemaURI_PA))
        

        if data_record.find("WEBSITE") is not None:
            gs.set(dbp.website, URIRef(data_record.find("WEBSITE").text))
        
        if data_record.find("EMAIL") is not None:
            gs.set(dbp.email, Literal(data_record.find("EMAIL").text))
        
        if data_record.find("LOCATION") is not None:
            location = data_record.find("LOCATION") 

            if location.find("ADDRESS")  is not None:              
                gs.set(dbp.location, Literal(location.find("ADDRESS").text))

            if location.find("CITY")  is not None:
                gs.set(dbp.city, Literal(location.find("CITY").text))

            if location.find("LAT") is not None:
                gs.set(geo.lat, Literal(location.find("LAT").text, datatype=XSD.decimal))

            if location.find("LNG") is not None:
                gs.set(geo.lng, Literal(location.find("LNG").text, datatype=XSD.decimal))  

# THEATRES
for data_record in theatreXML:
    theatreName = data_record.find("NAME").text
    print(theatreName)
    theatreURI = urify("http://www.comune.palermo.it/resource/theatres/", theatreName)
    gs = g.resource(theatreURI)
    gs.set(RDF.type, cpo.Theatre)

    gs.set(cpo.name, Literal(theatreName, lang='it'))
    gs.set(geo.lat, Literal(data_record.find("SEATS").text, datatype=XSD.integer))


    if data_record.find("LOCATION") is not None:
        location = data_record.find("LOCATION") 

        if location.find("ADDRESS")  is not None:              
            gs.set(dbp.location, Literal(location.find("ADDRESS").text))

        if location.find("LAT") is not None:
            gs.set(geo.lat, Literal(location.find("LAT").text, datatype=XSD.decimal))

        if location.find("LNG") is not None:
            gs.set(geo.lng, Literal(location.find("LNG").text, datatype=XSD.decimal))        

    #moden=data_record.find("IMAGE").text
    #mouri = urify("http://www.comune.palermo.it/resource/monumenti/", moden)
    #mo = g.resource(mouri)
    #mo.set(RDF.type, cpo.Monumento)
    #mo.set(cpo.indirizzo, Literal(data_record.find("INDIRIZZO").text, lang='it'))
    #gs.set(cpo.gestoredi, mo)

OUTPUT_PATH = '/comune_turismo.ttl'
g.serialize(destination=OUTPUT_PATH, format='turtle')


