<?php

namespace Trip\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * bikes
 *
 * @ORM\Table(name="bike_package")
 * @ORM\Entity
 */
class bikespackage
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
     * @ORM\Column(name="package_name", type="string", length=255)
     */
    private $packagename;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_price", type="integer")
     */
    private $packageprice;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_offer", type="integer")
     */
    private $packageoffer;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_status", type="integer")
     */
    private $packagestatus;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_kmlimit", type="integer")
     */
    private $packagekmlimit;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_excesskm", type="integer")
     */
    private $packageexcesskm;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_additional_km_limit", type="integer")
     */
    private $packageadditionalkmlimit;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="package_additional_price_day", type="integer")
     */
    private $packageadditionalpriceday;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="bike_id", type="integer")
     */
    private $bikeid;
    
    /**
     * @ORM\ManyToOne(targetEntity="Trip\SiteManagementBundle\Entity\bikes", inversedBy="bikespackage")
     * @ORM\JoinColumn(name="bike_id", referencedColumnName="id")
     */
    private $bikes;
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getPackagename()
    {
        return $this->packagename;
    }

    /**
     * @return integer
     */
    public function getPackageprice()
    {
        return $this->packageprice;
    }

    /**
     * @return integer
     */
    public function getPackageoffer()
    {
        return $this->packageoffer;
    }

    /**
     * @return integer
     */
    public function getPackagestatus()
    {
        return $this->packagestatus;
    }

    /**
     * @return integer
     */
    public function getPackagekmlimit()
    {
        return $this->packagekmlimit;
    }

    /**
     * @return integer
     */
    public function getPackageexcesskm()
    {
        return $this->packageexcesskm;
    }

    /**
     * @return integer
     */
    public function getPackageadditionalkmlimit()
    {
        return $this->packageadditionalkmlimit;
    }

    /**
     * @return integer
     */
    public function getPackageadditionalpriceday()
    {
        return $this->packageadditionalpriceday;
    }

    /**
     * @return integer
     */
    public function getBikeid()
    {
        return $this->bikeid;
    }

    /**
     * @return mixed
     */
    public function getBikes()
    {
        return $this->bikes;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param integer $packagename
     */
    public function setPackagename($packagename)
    {
        $this->packagename = $packagename;
    }

    /**
     * @param integer $packageprice
     */
    public function setPackageprice($packageprice)
    {
        $this->packageprice = $packageprice;
    }

    /**
     * @param integer $packageoffer
     */
    public function setPackageoffer($packageoffer)
    {
        $this->packageoffer = $packageoffer;
    }

    /**
     * @param integer $packagestatus
     */
    public function setPackagestatus($packagestatus)
    {
        $this->packagestatus = $packagestatus;
    }

    /**
     * @param integer $packagekmlimit
     */
    public function setPackagekmlimit($packagekmlimit)
    {
        $this->packagekmlimit = $packagekmlimit;
    }

    /**
     * @param integer $packageexcesskm
     */
    public function setPackageexcesskm($packageexcesskm)
    {
        $this->packageexcesskm = $packageexcesskm;
    }

    /**
     * @param integer $packageadditionalkmlimit
     */
    public function setPackageadditionalkmlimit($packageadditionalkmlimit)
    {
        $this->packageadditionalkmlimit = $packageadditionalkmlimit;
    }

    /**
     * @param integer $packageadditionalpriceday
     */
    public function setPackageadditionalpriceday($packageadditionalpriceday)
    {
        $this->packageadditionalpriceday = $packageadditionalpriceday;
    }

    /**
     * @param integer $bikeid
     */
    public function setBikeid($bikeid)
    {
        $this->bikeid = $bikeid;
    }

    /**
     * @param mixed $bikes
     */
    public function setBikes($bikes)
    {
        $this->bikes = $bikes;
    }

    
    
    

   

}
