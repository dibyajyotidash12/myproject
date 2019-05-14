<?php


namespace AppBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;


/**
* @MongoDB\Document
*/
class customer
{
    /**
     * @MongoDB\Id
     */
    Protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Name;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Mail;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Contact;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Address;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Status;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail)
    {
        $this->Mail = $mail;
        return $this;
    }

    /**
     * Get mail
     *
     * @return string $mail
     */
    public function getMail()
    {
        return $this->Mail;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return $this
     */
    public function setContact($contact)
    {
        $this->Contact = $contact;
        return $this;
    }

    /**
     * Get contact
     *
     * @return string $contact
     */
    public function getContact()
    {
        return $this->Contact;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->Address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->Status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->Status;
    }
}
