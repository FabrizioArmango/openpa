# Gestione e Schema Database 
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

# Salvataggio dei dati
## saveChurchesFromDBPedia.php
Questo file effettua una connessione al database, e una volta ricevuta la risposta alla richiesta al microservizio (openpa/microservices/churchHook.py), con le chiese prelevate da DBPedia, le invia una per una al database, salvando\aggiornando i relativi dati.

## saveQueryFromDBPedia.php
Questo file effettua una connessione al database, e una volta ricevuta la risposta alla richiesta al microservizio (openpa/microservices/foodHook.py), con i cibi tipici siciliani provenienti da DBPedia, li invia uno per il salvataggio\aggiornamento direttamente a Firebase.
Nello script è presente un ciclo, che viene eseguito una sola volta con il valore prefissato relativo al nome della regione Sicilia, ma preserva la possibilità di prelevare cibi tipici per ogni regione, per l'idea iniziale con la quale era stato progettato.

## saveTheatresFromPA.php
Salva i dati dei teatri su Firebase dal dataset dei Teatri Privati (Comune di Palermo: si veda openpa/datasets/README.md) presente sul server in cui avviene l'esecuzione, questo dataset si presenta in formato JSON post conversione con un tool online.

## saveTourismLocationFromPa.php
Questo file si occupa invece delle restanti entità presenti sul Dataset Turismo (Comune di Palermo: si veda openpa/datasets/README.md), che vengono prelevate direttamente dall'uri fornita dal Comune di Palermo in formato XML, trasformate come le altre in formato JSON e poi salvate su Firebase.

# API fornite
## PalermoAbout.php
Inviando una richiesta HTTP GET a questo script è possibile ricevere la lista delle entità richieste presenti su Firebase in formato JSON. 
E' necessario specificare il parametro listOf, le possibili opzioni sono le seguenti:
- theatres
- cinemas
- churchs
- typicalfoods
- pubs
- cocktailbars
- winebars
- streetfoods
- restaurants
- discos

Esempio di utilizzo:
http://palermo.linked-data.eu/php/PalermoAbout.php?listOf=churches

## PalermoAbout2.php
Il meccanismo di utilizzo è lo stesso di PalermoAbout.php, e le possibili opzioni sono le stesse.
La differenza in questa versione è che l'output è in un formato XML che è compatibile con le librerie per la creazione del grafo RDF.

