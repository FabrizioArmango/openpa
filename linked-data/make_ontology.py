pldo = Namespace("http://palermo.linked-data.eu/ontology/")

g = Graph ()

##### Classi
# Risorsa
gs = g.resource(pldo.Risorsa)
gs.set(RDF.type, RDF.Class) 

# Luogo
gs = g.resource(pldo.Luogo)
gs.set(RDF.type, RDF.Class) 
gs.set(RDFS.subClassOf. pldo.Risorsa)

# Chiesa
gs = g.resource(pldo.Chiesa)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Cinema
gs = g.resource(pldo.Cinema)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)
// gs.add(RDF.subclassOf, pldo.Turismo)

# Teatro
gs = g.resource(pldo.Teatro)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Pub
gs = g.resource(pldo.Pub)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# CocktailBar
gs = g.resource(pldo.CocktailBar)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.sublClassOf, pldo.Luogo)

# Enoteca
gs = g.resource(pldo.Enoteca)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.sublClassOf, pldo.Luogo)

# Cibo da strada
gs = g.resource(pldo.StreetFood)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Ristoranti
gs = g.resource(pldo.Ristorante)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# Discoteca
gs = g.resource(pldo.Discoteca)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Luogo)

# CiboTipico
gs = g.resource(pldo.CiboTipico)
gs.set(RDF.type, RDF.Class)
gs.set(RDFS.subClassOf, pldo.Risorsa)

# vicinoA
gs = g.resource(pldo.vicinoA)
gs.set(RDF.type, RDFS.Property)
gs.set(RDFS.domain, pldo.Luogo)
gs.set(RDFS.range, lgdo.Amenity)

# posti
gs = g.resource(pldo.posti)
gs.set(RDF.type, RDFS.Property)
gs.set(RDFS.domain, pldo.Teatro)
gs.set(RDFS.range, RDFS.Literal) # Literal, datatype=XSD.nonNegativeInteger


