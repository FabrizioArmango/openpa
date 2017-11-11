## TypicalFoods
### foodHook
Questo hook riceve come parametro da url country e regione, successivamente trasforma le informazioni ricevute in una query SPARQL. Tramite la libreria urllib di python, la query viene convertita ed elaborata, trovata l'url con requests viene effettuata una richiesta GET e il risultato viene convertito e gestito in formato JSON.

## Amenities
### amenityHook
Questo hook lavora esattamente nello steso modo del precedente, con l'unica differenza che i parametri sono la latitudine e la longitudine del luogo di interesse, il raggio d'azione nella query è settato a 200m.
## Churches
### churchHook
Come i precedenti a meno di parametri.
https://hook.io/elsinor/churchhook
