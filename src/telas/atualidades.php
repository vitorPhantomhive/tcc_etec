<?php
class Xml2Assoc {

/**
 * Optimization Enabled / Disabled
 *
 * @var bool
 */
protected $bOptimize = false;

/**
 * Method for loading XML Data from String
 *
 * @param string $sXml
 * @param bool $bOptimize
 */

public function parseString( $sXml , $bOptimize = false) {
    $oXml = new XMLReader();
    $this -> bOptimize = (bool) $bOptimize;
    try {

        // Set String Containing XML data
        $oXml->XML($sXml);

        // Parse Xml and return result
        return $this->parseXml($oXml);

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Method for loading Xml Data from file
 *
 * @param string $sXmlFilePath
 * @param bool $bOptimize
 */
public function parseFile( $sXmlFilePath , $bOptimize = false ) {
    $oXml = new XMLReader();
    $this -> bOptimize = (bool) $bOptimize;
    try {
        // Open XML file
        $oXml->open($sXmlFilePath);

        // // Parse Xml and return result
        return $this->parseXml($oXml);

    } catch (Exception $e) {
        echo $e->getMessage(). ' | Try open file: '.$sXmlFilePath;
    }
}

/**
 * XML Parser
 *
 * @param XMLReader $oXml
 * @return array
 */
protected function parseXml( XMLReader $oXml ) {

    $aAssocXML = null;
    $iDc = -1;

    while($oXml->read()){
        switch ($oXml->nodeType) {

            case XMLReader::END_ELEMENT:

                if ($this->bOptimize) {
                    $this->optXml($aAssocXML);
                }
                return $aAssocXML;

            case XMLReader::ELEMENT:

                if(!isset($aAssocXML[$oXml->name])) {
                    if($oXml->hasAttributes) {
                        $aAssocXML[$oXml->name][] = $oXml->isEmptyElement ? '' : $this->parseXML($oXml);
                    } else {
                        if($oXml->isEmptyElement) {
                            $aAssocXML[$oXml->name] = '';
                        } else {
                            $aAssocXML[$oXml->name] = $this->parseXML($oXml);
                        }
                    }
                } elseif (is_array($aAssocXML[$oXml->name])) {
                    if (!isset($aAssocXML[$oXml->name][0]))
                    {
                        $temp = $aAssocXML[$oXml->name];
                        foreach ($temp as $sKey=>$sValue)
                        unset($aAssocXML[$oXml->name][$sKey]);
                        $aAssocXML[$oXml->name][] = $temp;
                    }

                    if($oXml->hasAttributes) {
                        $aAssocXML[$oXml->name][] = $oXml->isEmptyElement ? '' : $this->parseXML($oXml);
                    } else {
                        if($oXml->isEmptyElement) {
                            $aAssocXML[$oXml->name][] = '';
                        } else {
                            $aAssocXML[$oXml->name][] = $this->parseXML($oXml);
                        }
                    }
                } else {
                    $mOldVar = $aAssocXML[$oXml->name];
                    $aAssocXML[$oXml->name] = array($mOldVar);
                    if($oXml->hasAttributes) {
                        $aAssocXML[$oXml->name][] = $oXml->isEmptyElement ? '' : $this->parseXML($oXml);
                    } else {
                        if($oXml->isEmptyElement) {
                            $aAssocXML[$oXml->name][] = '';
                        } else {
                            $aAssocXML[$oXml->name][] = $this->parseXML($oXml);
                        }
                    }
                }

                if($oXml->hasAttributes) {
                    $mElement =& $aAssocXML[$oXml->name][count($aAssocXML[$oXml->name]) - 1];
                    while($oXml->moveToNextAttribute()) {
                        $mElement[$oXml->name] = $oXml->value;
                    }
                }
                break;
            case XMLReader::TEXT:
            case XMLReader::CDATA:

                $aAssocXML[++$iDc] = $oXml->value;

        }
    }

    return $aAssocXML;
}

/**
 * Method to optimize assoc tree.
 * ( Deleting 0 index when element
 *  have one attribute / value )
 *
 * @param array $mData
 */
public function optXml(&$mData) {
    if (is_array($mData)) {
        if (isset($mData[0]) && count($mData) == 1 ) {
            $mData = $mData[0];
            if (is_array($mData)) {
                foreach ($mData as &$aSub) {
                    $this->optXml($aSub);
                }
            }
        } else {
            foreach ($mData as &$aSub) {
                $this->optXml($aSub);
            }
        }
    }
}

}

$t =  new Xml2Assoc();
$uga = $t->parseFile("https://feeds.folha.uol.com.br/educacao/rss091.xml");

$pagina = 10;
$total = 0;

if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
    $total = $pagina - 10;
}else{
    $pagina = 10;
    $total = 0;
}

?>
<body style="background: #E5E5E5">

<link rel="stylesheet" href="/site/public/styles/atualidades.css">

<?php

for ($total; $total < $pagina; $total++) { 
    $title = $uga["rss"][0]["channel"]["item"][$total]["title"][0];
    $description = $uga["rss"][0]["channel"]["item"][$total]["description"][0];

    echo "<div class='divAtu'><h4>$title<h4><h5>$description</h5></div>";
}

?>
<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-center">
    <?php
    if($pagina == 10){
        
    ?>
        <li class="page-item disabled">
            <a class="page-link" href="atualidades.php?pagina=0" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
    } else{

    ?>
        <li class="page-item">
            <a class="page-link" href="atualidades.php?pagina=<?php echo $pagina - 10 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php
    }
    ?>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=10">1</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=20">2</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=30">3</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=40">4</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=50">5</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=60">6</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=70">7</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=80">8</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=90">9</a></li>
    <li class="page-item"><a class="page-link" href="atualidades.php?pagina=100">10</a></li>

    <?php
    if($pagina == 100){
        
    ?>
        <li class="page-item disabled">
            <a class="page-link" href="atualidades.php?pagina=0" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <?php
    } else{

    ?>
        <li class="page-item">
            <a class="page-link" href="atualidades.php?pagina=<?php echo $pagina + 10 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    <?php
    }
    ?>
  </ul>
</nav>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>