<?php
namespace Trip\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_docs")
 */
class UserDocuments
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;   
    /**
     * @var integer
   	 * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;
    /**
     * @var integer
   	 * @ORM\Column(name="doc_id", type="integer")
     */
    private $documentId;
	 /**
     * @var string
     * @ORM\Column(name="file_name", type="string", length=100)
     */
    private $fileName;

	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getUserId() {
		return $this->userId;
	}
	
	/**
	 *
	 * @param
	 * $userId
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
		return $this;
	}
	/**
	 *
	 * @return the integer
	 */
	public function getDocumentId() {
		return $this->documentId;
	}
	
	/**
	 *
	 * @param
	 * $documentId
	 */
	public function setDocumentId($documentId) {
		$this->documentId = $documentId;
		return $this;
	}
	/**
	 *
	 * @return the string
	 */
	public function getFileName() {
		return $this->fileName;
	}
	
	/**
	 * @param
	 * $firstName
	 */
	public function setFileName($fileName) {
		$this->fileName = $fileName;
		return $this;
	}
}