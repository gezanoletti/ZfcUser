<?php

namespace ZfcUser\Entity;

use ZfcRbac\Identity\IdentityInterface;

class User implements UserInterface, IdentityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
    
    /**
     * @see \ZfcRbac\Identity\IdentityInterface::getRoles()
     */
    public function getRoles() {
    	$link = mysql_connect('localhost', 'root', 'root');
    	if (!$link) {
    		die('Could not connect: ' . mysql_error());
    	}
    	
    	$db = 'tsv';
    	$query = 'SELECT rr.role_name FROM '.$db.'.user_role ur INNER JOIN '.$db.'.rbac_role rr ON ur.role_id = rr.role_id WHERE ur.user_id = ' . $this->id;
    	$result = mysql_query($query);

    	$roles = array();
    	while ($row = mysql_fetch_assoc($result)) {
    		$roles[] = $row['role_name'];
    	}
    	
    	mysql_close($link);
//     	var_dump($roles);
    	return $roles;
    }
}
