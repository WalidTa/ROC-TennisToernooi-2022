<?php

class database{
    private $host;
    private $dbh;
    private $user;
    private $pass;
    private $db;

   
    function __construct(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'toernooi';
 
        
        try{
            $dsn = "mysql:host=$this->host;dbname=$this->db";
            $this->dbh = new PDO($dsn, $this->user, $this->pass); 
        }catch(PDOException $e){
            die("Unable to connect: " . $e->getMessage());
        }
    
    }


    // hier boven is de constructor die word gebruikt om de database te verbinden
    // hier onder zijn de functies

    // een simpele functie die de spelers en hun scholen laten zien
    public function showSpelers(){
        try {
            $query = $this->dbh->query(
                "SELECT *,
                scholen.naam AS schoolnaam
            FROM
                spelers
            INNER JOIN scholen ON spelers.school_ID = scholen.schoolID;
        ");

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een showspecific function die alleen de spelers laat zien die in dat toernooi zijn aangemeld
    public function showSpecificSpelers($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT * 
                FROM 
                    aanmelding 
                    INNER JOIN spelers ON aanmelding.speler_ID = spelers.spelerID 
                    INNER JOIN toernooien ON aanmelding.toernooi_ID = toernooien.toernooiID 
                    WHERE aanmelding.toernooi_ID = :id;
        ");

        $query->execute([
                'id' => $id
            ]);

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een selectspecific let op het het verschil, show en select specific. de select selecteerd de persoon die je hebt aangewezen 
    public function SelectSpecificSpeler($id) {
        try {
            $query = $this->dbh->prepare(
                "SELECT *,
                scholen.naam AS schoolnaam
            FROM
                spelers
            INNER JOIN scholen ON spelers.school_ID = scholen.schoolID
            WHERE
                spelerID = :id");

            $query->execute([
                'id' => $id
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een update functie, dit is om spelers te wijzigen.
    public function updateSpeler($voornaam, $tussenvoegsel, $achternaam, $schoolID, $id){
        try {
            $query = $this->dbh->prepare(
                "UPDATE
                spelers
            SET
                voornaam = :voornaam,
                tussenvoegsel = :tussenvoegsel,
                achternaam = :achternaam,
                school_ID = :schoolID
            WHERE
                spelerID = :id ;"
            ); 
                
            $query->execute([
                'voornaam' => $voornaam,
                'tussenvoegsel' => $tussenvoegsel,
                'achternaam' => $achternaam,
                'schoolID' => $schoolID,
                'id' => $id
            ]);

            header("Location: spelers.php");

            exit;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een show functie, deze laat scholen zien
    public function showSchool(){
        try {
            $query = $this->dbh->query(
                "SELECT * 
                FROM 
                    scholen");

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een delete functie, deze delete de speler die jij aanwijst
    public function deleteSpeler($id){
        try {
            $query = $this->dbh->prepare(
                "DELETE
                FROM
                    spelers
                WHERE
                    spelerID = :id;"
            );

            $query->execute([
                'id' => $id
            ]);

            header("Location: spelers.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }
    
    //een create functie deze maakt een speler aan
    public function createSpeler($voornaam, $tussenvoegsel, $achternaam, $schoolID){
        try {
            $query = $this->dbh->prepare(
                "INSERT INTO spelers(
                    voornaam,
                    tussenvoegsel,
                    achternaam,
                    school_ID
                )
                VALUES(
                    :voornaam,
                    :tussenvoegsel,
                    :achternaam,
                    :schoolID
                );"
                 );

            $query->execute([
                'voornaam' => $voornaam,
                'tussenvoegsel' => $tussenvoegsel,
                'achternaam' => $achternaam,
                'schoolID' => $schoolID
            ]);

            header("Location: spelers.php");

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een select specific om de juiste school te selecteren
    public function SelectSpecificSchool($id) {
        try {
            $query = $this->dbh->prepare(
                "SELECT
                *
            FROM
                scholen
            WHERE
                schoolID = :id");

            $query->execute([
                'id' => $id
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een update functie deze wijzigd een school die je hebt aangewezen met de vorige functie
    public function updateSchool($naam, $id){
        try {
            $query = $this->dbh->prepare(
                "UPDATE
                scholen
            SET
                naam = :naam
            WHERE
                schoolID = :id;"
            ); 
                
            $query->execute([
                'naam' => $naam,
                'id' => $id
            ]);

            header("Location: school.php");

            exit;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een create functie, deze maakt een school aan
    public function createSchool($naam){
        try {
            $query = $this->dbh->prepare(
                "INSERT INTO scholen(naam)
                VALUES(:naam);"
                 );

            $query->execute([
                'naam' => $naam
            ]);

            header("Location: school.php");

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een delete functie, deze delete de school die jij aanwijst
    public function deleteSchool($id){
        try {
            $query = $this->dbh->prepare(
                "DELETE
                FROM
                    scholen
                WHERE
                    schoolID = :id;"
            );

            $query->execute([
                'id' => $id
            ]);

            header("Location: school.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een show functie die de toernooien selecteerd
    public function showToernooi(){
        try {
            $query = $this->dbh->query(
                "SELECT * 
                FROM 
                    toernooien");

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een selectspecific om het juiste toernooi te pakken
    public function SelectSpecificToernooi($id) {
        try {
            $query = $this->dbh->prepare(
                "SELECT *
            FROM
                toernooien
            WHERE
                toernooiID = :id");

            $query->execute([
                'id' => $id
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een update functie, deze wijzigd het toernooi die is aangewezen 
    public function updateToernooi($omschrijving, $datum, $id){
        try {
            $query = $this->dbh->prepare(
                "UPDATE
                toernooien
            SET
                omschrijving = :omschrijving,
                datum = :datum
            WHERE
                toernooiID = :id;"
            ); 
                
            $query->execute([
                'omschrijving' => $omschrijving,
                'datum' => $datum,
                'id' => $id
            ]);

            header("Location: toernooi.php");

            exit;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een create functie, deze maakt een nieuw toernooi
    public function createToernooi($omschrijving, $datum){
        try {
            $query = $this->dbh->prepare(
                "INSERT INTO toernooien(omschrijving, datum)
                VALUES(:omschrijving, :datum);"
                 );

            $query->execute([
                'omschrijving' => $omschrijving,
                'datum' => $datum
            ]);

            header("Location: toernooi.php");

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een delete functie, deze delete het toernooi die is aangegeven
    public function deleteToernooi($id){
        try {
            $query = $this->dbh->prepare(
                "DELETE
                FROM
                    toernooien
                WHERE
                    toernooiID = :id;"
            );

            $query->execute([
                'id' => $id
            ]);

            header("Location: toernooi.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een show functie, deze laat de goeie aanmeldingen zien. de aanmeldingen moeten het toernooi id matchen. 
    //de toernooi id neemt hij mee via de url
    public function showAanmelding($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *
                FROM
                    aanmelding
                INNER JOIN spelers ON spelers.spelerID = aanmelding.speler_ID
                INNER JOIN toernooien ON toernooien.toernooiID = aanmelding.toernooi_ID
                INNER JOIN scholen ON spelers.school_ID = scholen.schoolID
                WHERE toernooi_ID = :id;");

                $query->execute([
                'id' => $id
            ]); 

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een select specific functie, deze selecteerd de juiste aanmelding
    public function SelectSpecificAanmelding($id) {
        try {
            $query = $this->dbh->prepare(
                "SELECT *
            FROM
                aanmelding
            INNER JOIN spelers ON spelers.spelerID = aanmelding.speler_ID
            INNER JOIN toernooien ON toernooien.toernooiID = aanmelding.toernooi_ID
            WHERE
                aanmeldingID = :id;");

            $query->execute([
                'id' => $id
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //de update functie voor de aanmeldingen die jij selecteerd
    public function updateAanmelding($spelerID, $toernooiID, $id){
        try {
            $query = $this->dbh->prepare(
                "UPDATE
                aanmelding
            SET
                speler_ID = :speler_ID,
                toernooi_ID = :toernooi_ID
            WHERE
                aanmeldingID = :id;"
            ); 
                
            $query->execute([
                'speler_ID' => $spelerID,
                'toernooi_ID' => $toernooiID,
                'id' => $id
            ]);

            header("Location: toernooi.php");

            exit;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een create functie om aanmeldingen aan te maken
    public function createAanmelding($id, $speler_ID){
        try {
            $query = $this->dbh->prepare(
                "INSERT INTO aanmelding(toernooi_ID, speler_ID)
                VALUES(:id, :speler_ID );"
                 );

            $query->execute([
                'id' => $id,
                'speler_ID' => $speler_ID
                
            ]);

            header("Location: toernooi.php");

        } catch (\PDOException $e) {
            throw $e;
        }
    }  

    //een delete functie om aanmeldingen te verwijderen
    public function deleteAanmelding($id){
        try {
            $query = $this->dbh->prepare(
                "DELETE
                FROM
                    aanmelding
                WHERE
                    aanmeldingID = :id;"
            );

            $query->execute([
                'id' => $id
            ]);

            header("Location: toernooi.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een show functie om de juiste wedstrijden te selecteren
    //alleen de wedstrijden van het toernooi die jij hebt geselecteerd worden geselecteerd
    public function showWedstrijd($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *, 
                speler1.voornaam AS speler1, 
                speler2.voornaam as speler2, 
                spelerwin.voornaam AS winnaar 
                FROM wedstrijd 
                INNER JOIN toernooien ON toernooien.toernooiID = wedstrijd.toernooi_ID 
                INNER JOIN spelers speler1 ON speler1.spelerID = wedstrijd.speler1ID 
                INNER JOIN spelers speler2 ON speler2.spelerID = wedstrijd.speler2ID 
                INNER JOIN spelers spelerwin ON spelerwin.spelerID = wedstrijd.winnaarID
                WHERE wedstrijd.toernooi_ID = :id
                ;");

                $query->execute([
                'id' => $id
            ]);

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    // een show functie deze is om de eerste ronde in een toernooi te laten zien
    public function showOverzichtToernooi($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *, 
                speler1.voornaam AS speler1, 
                speler2.voornaam as speler2, 
                spelerwin.voornaam AS winnaar 
            FROM
                wedstrijd
            INNER JOIN toernooien ON toernooien.toernooiID = wedstrijd.toernooi_ID
            INNER JOIN spelers speler1 ON speler1.spelerID = wedstrijd.speler1ID 
                INNER JOIN spelers speler2 ON speler2.spelerID = wedstrijd.speler2ID 
                INNER JOIN spelers spelerwin ON spelerwin.spelerID = wedstrijd.winnaarID
            WHERE
                wedstrijd.toernooi_ID = :id
            AND 
                wedstrijd.ronde = 1;");

        $query->execute([
            'id' => $id
        ]);
            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    // nog een showfunctie deze is om de tweede ronde en verder te selecteren van het toernooi naar keuzen
    public function showOverzichtToernooi2($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *, 
                speler1.voornaam AS speler1, 
                speler2.voornaam as speler2, 
                spelerwin.voornaam AS winnaar 
            FROM
                wedstrijd
            INNER JOIN toernooien ON wedstrijd.toernooi_ID = toernooien.toernooiID
            INNER JOIN spelers speler1 ON speler1.spelerID = wedstrijd.speler1ID 
                INNER JOIN spelers speler2 ON speler2.spelerID = wedstrijd.speler2ID 
                INNER JOIN spelers spelerwin ON spelerwin.spelerID = wedstrijd.winnaarID
            WHERE
                wedstrijd.toernooi_ID = :id
                AND
                wedstrijd.ronde >=2
                ORDER BY ronde ASC
            ;");

        $query->execute([
            'id' => $id
        ]);
            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    // de derde en laatste showoverzichttoernooi functie, deze laat alleen de laatste wedstrijd zien
    public function showOverzichtToernooi3($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *, 
                speler1.voornaam AS speler1, 
                speler2.voornaam as speler2, 
                spelerwin.voornaam AS winnaar 
            FROM
                wedstrijd
            INNER JOIN toernooien ON wedstrijd.toernooi_ID = toernooien.toernooiID
            INNER JOIN spelers speler1 ON speler1.spelerID = wedstrijd.speler1ID 
                INNER JOIN spelers speler2 ON speler2.spelerID = wedstrijd.speler2ID 
                INNER JOIN spelers spelerwin ON spelerwin.spelerID = wedstrijd.winnaarID
            WHERE
                wedstrijd.toernooi_ID = :id

                ORDER BY ronde DESC LIMIT 1;");

        $query->execute([
            'id' => $id
        ]);
            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een create functie om een wedstrijd te maken
    public function createWedstrijd($toernooiID, $ronde, $speler1, $speler2, $score1, $score2, $winnaar){
        try {
            $query = $this->dbh->prepare(
                "INSERT INTO wedstrijd(toernooi_ID, ronde, speler1ID, speler2ID, score1, score2, winnaarID)
                VALUES(:toernooi_ID, :ronde, :speler1ID, :speler2ID, :score1, :score2, :winnaarID);"
                 );

            $query->execute([
                'toernooi_ID' => $toernooiID,
                'ronde' => $ronde,
                'speler1ID' => $speler1,
                'speler2ID' => $speler2,
                'score1' => $score1,
                'score2' => $score2,
                'winnaarID' => $winnaar
            ]);

            header("Location: toernooi.php");

        } catch (\PDOException $e) {
            throw $e;
        }
    }  

    //een selectspecific functie om een specifieke wedstrijd te selecteren 
    public function SelectSpecificWedstrijd($id){
        try {
            $query = $this->dbh->prepare(
                "SELECT *, sp1.voornaam AS speler1, sp2.voornaam as speler2, spwin.voornaam AS winnaar
                    FROM wedstrijd
                        INNER JOIN toernooien ON toernooien.toernooiID = wedstrijd.toernooi_ID
                        INNER JOIN spelers sp1 ON sp1.spelerID = wedstrijd.speler1ID 
                        INNER JOIN spelers sp2 ON sp2.spelerID = wedstrijd.speler2ID
                        INNER JOIN spelers spwin ON spwin.spelerID =  wedstrijd.winnaarID
                            WHERE wedstrijdID = :id;");

            $query->execute([
                'id' => $id
            ]);

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    // een update functie om de wedstrijd naar keuze te wijzigen
    public function updateWedstrijd($id, $toernooiID, $ronde, $speler1ID, $speler2ID, $score1, $score2, $winnaarID){
        try {
            $query = $this->dbh->prepare(
                "UPDATE
                wedstrijd
            SET
                toernooi_ID = :toernooi_ID,
                ronde = :ronde,
                speler1ID = :speler1ID,
                speler2ID = :speler2ID,
                score1 = :score1,
                score2 = :score2,
                winnaarID = :winnaarID
            WHERE
                wedstrijdID = :id;"
            ); 
                
            $query->execute([
                'toernooi_ID' => $toernooiID,
                'ronde' => $ronde,
                'speler1ID' => $speler1ID,
                'speler2ID' => $speler2ID,
                'score1' => $score1,
                'score2' => $score2,
                'winnaarID' => $winnaarID,
                'id' => $id
            ]);

            header("Location: toernooi.php");

            exit;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    //een delete functie om de geselecteerde wedstrijd te verwijderen
    public function deleteWedstrijd($id){
        try {
            $query = $this->dbh->prepare(
                "DELETE
                FROM
                    wedstrijd
                WHERE
                    wedstrijdID = :id;"
            );

            $query->execute([
                'id' => $id
            ]);

            header("Location: toernooi.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

}

?>