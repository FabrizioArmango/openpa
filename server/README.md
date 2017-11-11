## Firebase.php
La classe Firebase serve ad interfacciarsi con il database tramite richieste cURL. 
Per semplicità di sviluppo e la mancata necessità di sicurezza per gli scopi dell'attuale progetto, il database di riferimento non richiede permessi per la lettura e scrittura.
Di conseguenza non sono stati implementati meccanismi di autenticazione.

Le funzioni :
- function saveFood($food)
- function saveTheatre($teatro)
- function saveChurch($church)
- function saveTourismLocation($loc)
consentono il salvataggio delle singole entità ricavate dai datasets.

Invece la funzione
- function getListOf($what, $root=false)
consente la lettura delle entità dal database e le restituisce in formato JSON.

E' presente anche una funzione di utilità, che restituisce il nome della relativa tabella del database, data la categoria.
- function fixTableName($des)


## FirebaseChurch.php, FirebaseFood.php, FirebaseTheatre.php, FireBaseTourismLocation.php
In questi files sono presenti le classi che definiscono lo schema del database.
Tutte implementano la funzione:
- function toFirebaseJSON()
che restituisce la rappresentazione in formato JSON delle instanze delle entità, da inviare per il salvataggio.

In FirebaseChurch.php e FirebaseFood.php è presente anche una funzione per trasformare la URI di DBPedia prima del salvataggio.

FirebaseTheatre.php e FireBaseTourismLocation.php rappresentano invece le entità provenienti dai datasets resi disponibili dal Comune di Palermo.

##
