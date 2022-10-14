<?php
class panier{

    private $DB;

    public function __construct($DB){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        $this->DB = $DB;

        if(isset($_POST['panier']['quantity'])){
            $this->calcul();
            }
        if(isset($_POST['submit'])){
            $this->insert();
        }
    }

    public function calcul(){
        foreach($_SESSION['panier'] as $paccueil_id => $quantity){
            if(isset($_POST['panier']['quantity'][$paccueil_id])){
                $_SESSION['panier'][$paccueil_id] = $_POST['panier']['quantity'][$paccueil_id];
            }
        }
    }

    public function count(){
        return array_sum($_SESSION['panier']);
    }

    public function total(){
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
            $paccueil = array();
        }else{
            $paccueil = $this->DB->query('SELECT id, prix FROM paccueil WHERE id IN ('.implode(',',$ids).')');
        }
        foreach( $paccueil as $paccueil ){
            $total += $paccueil->prix * $_SESSION['panier'][$paccueil->id];
        }
        return $total;
    }

    public function add($paccueil_id){
        if(isset($_SESSION['panier'][$paccueil_id])){
            $_SESSION['panier'][$paccueil_id]++;
        }else{
            $_SESSION['panier'][$paccueil_id] =1;
        }
    }
    public function del($paccueil_id){
        unset($_SESSION['panier'][$paccueil_id]);
    }

    public function qts(){
        $qts = 0;
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
        $paccueil = array();
        }else{
            $paccueil = $this->DB->query('SELECT id, prix FROM paccueil WHERE id IN ('.implode(',',$ids).')');
        }
        foreach( $paccueil as $paccueil ){
            $qts = $paccueil->prix * $_SESSION['panier'][$paccueil->id];
        }
        return $qts;
    }

    public function insert(){

        if(isset($_POST['prenom']) and isset($_POST['nom']) and isset($_POST['ville']) and isset($_POST['pays']) and isset($_POST['arrondissement'])
                and isset($_POST['reference']) and isset($_POST['quartier']) and isset($_POST['numero']))
                {
                    if(!empty($_POST['prenom']) and !empty($_POST['nom']) and !empty($_POST['ville']) and !empty($_POST['pays']) and !empty($_POST['arrondissement'])
                and !empty($_POST['reference']) and !empty($_POST['quartier']) and !empty($_POST['numero']))
                {
                    $prenom = htmlspecialchars($_POST['prenom']);
                    $nom = htmlspecialchars($_POST['nom']);
                    $ville = htmlspecialchars($_POST['ville']);
                    $pays = htmlspecialchars($_POST['pays']);
                    $arrondissement = htmlspecialchars($_POST['arrondissement']);
                    $reference = htmlspecialchars($_POST['reference']);
                    $quartier = htmlspecialchars($_POST['quartier']);
                    $numero = htmlspecialchars($_POST['numero']);
        
                    
                    if(strlen($prenom) <= 100){}
                    if(strlen($nom) <= 100){}
                        if(strlen($ville) <= 100){}
                            if(strlen($pays) <= 100){}
                                if(strlen($arrondissement) <= 100){}
                                    if(strlen($reference) <= 100){}
                                        if(strlen($quartier) <= 100){}
                                            if(strlen($numero) <= 100){}
        
                    $req = $this->DB->query("INSERT INTO client (prenom, nom, ville, pays, arrondissement, reference, quartier,
                    numero  VALUES (:prenom, :nom, :ville, :pays, :arrondissement, :reference, :quartier, :numero)");
        



        $req->execute(array(
            $prenom, 
            $nom, 
            $ville, 
            $pays, 
            $arrondissement, 
            $reference, 
            $quartier, 
            $numero));




                    /*$req->execute(array(
                            'prenom' => $prenom, 
                            'nom' => $nom, 
                            'ville' => $ville, 
                            'pays' => $pays, 
                            'arrondissement' => $arrondissement, 
                            'reference' => $reference, 
                            'quartier' => $quartier, 
                            'numero' => $numero));*/
                    
        
                }
                }
            }
        
    }