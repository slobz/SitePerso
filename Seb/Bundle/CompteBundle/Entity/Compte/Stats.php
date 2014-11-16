<?php

namespace Seb\Bundle\CompteBundle\Entity\Compte;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stats
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Stats
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var integer
     *
     * @ORM\Column(name="mois", type="integer")
     */
    private $mois;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_debit", type="integer")
     */
    private $totalDebit = 0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="total_credit", type="integer")
     */
    private $totalCredit = 0;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     * @return Stats
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set mois
     *
     * @param integer $mois
     * @return Stats
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return integer 
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set totalDebit
     *
     * @param integer $totalDebit
     * @return Stats
     */
    public function setTotalDebit($totalDebit)
    {
        $this->totalDebit = $totalDebit;

        return $this;
    }

    /**
     * Get totalDebit
     *
     * @return integer 
     */
    public function getTotalDebit()
    {
        return $this->totalDebit;
    }

    /**
     * Set totalCredit
     *
     * @param integer $totalCredit
     * @return Stats
     */
    public function setTotalCredit($totalCredit)
    {
        $this->totalCredit = $totalCredit;

        return $this;
    }

    /**
     * Get totalCredit
     *
     * @return integer 
     */
    public function getTotalCredit()
    {
        return $this->totalCredit;
    }
    
    /**
     * Recourci pour setTotalCredit/setTotalDebit
     * @param type $montant
     * @param type $debit
     */
    public function setMontant($montant,$debit){
        
        if($debit){
            $this->totalDebit+=$montant;
        }else{
            $this->totalCredit+=$montant;
        }
        
    }
    
}
