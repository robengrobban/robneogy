# robneogy
Robert och Neo gymnasiearbete.

# Installation
1. Ladda ner projektet
2. Placera projektets mapp i ett program som kan simulera en server, så som XAMPP.
3. Gå till mappen php som finns där projektet plaserades, sedan include och öppna connect-database.php.
4. Ändra $serverip till databas IP, så som localhost.
5. Ändra $username och $password till något passande.
6. Importera den senaste databas backupen till MySQL med databasnamnet databaseGy, om annat måste variabelnamnet $database ändras i connect-database.php. Det finns en map 'db-backup' på projektet där databas backupen finns.
7. Kör projektet!

# Var uppmärksam på följande
1. För att återställa lösenord systemet ska fungera måste mail funktionen vara inställd i XAMPP. Annars kommer inga mail att skickas.
2. För att kunna ladda upp foton för sin profil måste XAMPP vara inställd med följande:
  a. Tillåta filöverföring.
  b. Inställt en lämplig maxgräns för filöverföring. 
