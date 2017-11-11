## Ontology 
#### XML http://palermo.linked-data.eu/ontology/
#### Turtle http://palermo.linked-data.eu/ontology/ontology.ttl

| Namespace Declarations | |
| --- | --- |
| pldo | http://palermo.linked-data.eu/ontology/ | 
| owl | http://www.w3.org/2002/07/owl# |
| rdf | http://www.w3.org/1999/02/22-rdf-syntax-ns# |
| rdfs | http://www.w3.org/2000/01/rdf-schema# |
| lgdo | http://linkedgeodata.org/ontology/ |

| Classes | |
| --- | --- |
| Risorsa | rdf:type->owl:Class |
| Luogo | rdf:type->owl:Class; rdfs:subClassOf->pldo:Risorsa |
| CocktailBar | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| StreetFood | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| CiboTipico | rdf:type->owl:Class; rdfs:subClassOf->pldo:Risorsa |
| Enoteca | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Restaurant | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Teatro | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Pub | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Discoteca | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Chiesa | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |
| Cinema | rdf:type->owl:Class; rdfs:subClassOf->pldo:Luogo |

| Data Properties | |
| --- | --- |
| vicinoA | rdf:type->rdf:Property; rdfs:domain->pldo:Luogo; rdfs:range->lgdo:Amenity ::: Viene utilizzato per descrivere vicinanza di 200metri |

## Graph 
#### XML http://palermo.linked-data.eu/graph/
#### Turtle http://palermo.linked-data.eu/graph/grafo.ttl

