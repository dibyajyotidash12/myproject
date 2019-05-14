<?php


namespace AppBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;



/**
 * @MongoDB\Document
 */
class activity
{
    /**
    * @MongoDB\Id
    */
    Protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $userId;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $userName;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $customerId;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $customerName;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $ActivityType;
    /**
     * @MongoDB\Field(type="date")
     */
    Protected $Time;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $Description;
    /**
     * @MongoDB\Field(type="string")
     */
    Protected $NextActivityDescription;
    /**
     * @MongoDB\Field(type="date")
     */
    Protected $NextActivityTime;

   

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
     * Set userId
     *
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get userId
     *
     * @return string $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * Get userName
     *
     * @return string $userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set customerId
     *
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * Get customerId
     *
     * @return string $customerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     * @return $this
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
        return $this;
    }

    /**
     * Get customerName
     *
     * @return string $customerName
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set activityType
     *
     * @param string $activityType
     * @return $this
     */
    public function setActivityType($activityType)
    {
        $this->ActivityType = $activityType;
        return $this;
    }

    /**
     * Get activityType
     *
     * @return string $activityType
     */
    public function getActivityType()
    {
        return $this->ActivityType;
    }

    /**
     * Set time
     *
     * @param date $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->Time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return date $time
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Set nextActivityDescription
     *
     * @param string $nextActivityDescription
     * @return $this
     */
    public function setNextActivityDescription($nextActivityDescription)
    {
        $this->NextActivityDescription = $nextActivityDescription;
        return $this;
    }

    /**
     * Get nextActivityDescription
     *
     * @return string $nextActivityDescription
     */
    public function getNextActivityDescription()
    {
        return $this->NextActivityDescription;
    }

    /**
     * Set nextActivityTime
     *
     * @param date $nextActivityTime
     * @return $this
     */
    public function setNextActivityTime($nextActivityTime)
    {
        $this->NextActivityTime = $nextActivityTime;
        return $this;
    }

    /**
     * Get nextActivityTime
     *
     * @return date $nextActivityTime
     */
    public function getNextActivityTime()
    {
        return $this->NextActivityTime;
    }
}
