Campurile/flag-urile din mesajul de raspuns care stabilesc felul in care trebuie tratata tranzatia sunt:

#### Campul "ACTION" 
_String(1)_
* 0 - tranzactie aprobata
* 1 - tranzactie duplicata
* 2 - tranzatie respinsa
* 3 - eroare de procesare

#### Campul "RC" 
_String(2)_ 
Valoare generata de banca emitenta conform standardului ISO8583. 
Puteti descarca o lista cu coduri posibile aici. 
(https://www.activare3dsecure.ro/teste3d/error.txt)
* 00 - tranzactie aprobata
* orice alt cod - tranzactie respinsa

#### Campul "MESSAGE" 
_String(1-50)_ 
Descrierea codului de eroare din campul RC
* Approved - pentru RC=00
* Transaction declined/Authentication failed/etc pentru erorile aparute.

Asadar comanda este considerata "platita" atunci cand campul "ACTION"="0" sau cand "RC"="00". 
Orice alte valori reprezinta erori. 
Dupa preluarea raspunsului LibraPay, clientul trebuie informat cu privire la starea comenzii (finalizata cu succes sau nefinalizata).