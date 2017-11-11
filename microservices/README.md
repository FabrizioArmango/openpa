## TypicalFoods
### foodHook
Questo hook riceve come parametro da url country e regione, successivamente trasforma le informazioni ricevute in una query SPARQL. Tramite la libreria urllib di python, la query viene convertita ed elaborata, trovata l'url con requests viene effettuata una richiesta GET e il risultato viene convertito e gestito in formato JSON. 
Link esempio: https://hook.io/elsinor/foodhook?region=Sicily&country=Italy

## Amenities
### amenityHook
Questo hook lavora esattamente nello steso modo del precedente, con l'unica differenza che i parametri sono la latitudine e la longitudine del luogo di interesse, il raggio d'azione nella query è settato a 200m.
Link esempio: https://hook.io/elsinor/amenityhook?lat=38.117665&lng=13.3678464
(Per evitare che alcune queries dessero l'errore di superamento timeout d'esecuzione presente di default sulla piattaforma hook.io, il microservizio è stato eseguito direttamente sul nostro server tramite moduli Node.js).

## Churches
### churchHook
Come i precedenti a meno di parametri. 
Link esempio: https://hook.io/elsinor/churchhook
