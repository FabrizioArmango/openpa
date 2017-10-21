import urllib.request
import json
from dicttoxml import dicttoxml
import xml.etree.ElementTree as ET
from rdflib import Graph, Literal, Namespace, URIRef
from rdflib.namespace import RDF, RDFS, FOAF, OWL, XSD, DC, DCTERMS

#API_URL = "http://localhost/php/PalermoAbout2.php";
def urify(ns, testo):
    testo=testo.replace(" ","_").replace(".","")
    return ns+urllib.parse.quote(testo)
    
g = Graph()

# Define Namespaces

pldo = Namespace("http://palermo.linked-data.eu/ontology/")
lgdo = Namespace("http://linkedgeodata.org/ontology/")
####### ->
# Namespace Bindings
#added to avoid output ns1
g.bind("owl", OWL)

g.bind("pldo", pldo)
g.bind("lgdo", lgdo)
####### ->


##### Classi
# Risorsa
gs = g.resource(pldo.Risorsa)
gs.set(RDF.type, OWL.Class) 

# Luogo
gs = g.resource(pldo.Luogo)
gs.set(RDF.type, OWL.Class) 
gs.set(RDFS.subClassOf, pldo.Risorsa)

# Chiesa
gs = g.resource(pldo.Chiesa)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Cinema
gs = g.resource(pldo.Cinema)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)
# gs.add(RDF.subclassOf, pldo.Turismo)

# Teatro
gs = g.resource(pldo.Teatro)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Pub
gs = g.resource(pldo.Pub)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# CocktailBar
gs = g.resource(pldo.CocktailBar)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Enoteca
gs = g.resource(pldo.Enoteca)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Cibo da strada
gs = g.resource(pldo.StreetFood)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Ristoranti
gs = g.resource(pldo.Restaurant)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Discoteca
gs = g.resource(pldo.Discoteca)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# CiboTipico
gs = g.resource(pldo.CiboTipico)
gs.set(RDF.type, OWL.Class)
gs.set(RDFS.subClassOf, pldo.Risorsa)

##### Proprietà 
# nome
gs = g.resource(pldo.nome)
gs.set(RDF.type, RDF.Property)
gs.set(RDFS.domain, pldo.Risorsa)
gs.set(RDFS.range, RDFS.Literal)

# vicinoA
gs = g.resource(pldo.vicinoA)
gs.set(RDF.type, RDF.Property)
gs.set(RDFS.domain, pldo.Luogo)
gs.set(RDFS.range, lgdo.Amenity)

# posti
gs = g.resource(pldo.posti)
gs.set(RDF.type, RDFS.Property)
gs.set(RDFS.domain, pldo.Luogo)
gs.set(RDFS.range, XSD.nonNegativeInteger)


OUTPUT_PATH = 'ontology.ttl'
g.serialize(destination=OUTPUT_PATH, format='turtle')
