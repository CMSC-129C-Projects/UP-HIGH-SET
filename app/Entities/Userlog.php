<?php
namespace App\Entities;

use \CodeIgniter\Entity;

class Userlog extends Entity {

    private $request;

    protected $attributes = [
        'user_id' => null,
        'ip_address' => null,
        'type' => null,
        'user_token' => null,
        'platform' => null,
        'user_agent' => null,
        'is_deleted' => null
    ];

    function __construct($request) {
        $this->request = $request;
    }

    /**
     * Auto Login
     */
    public function fillUserlogData($user_id)
    {
        $user_token = $this->rand_string(100);
        $currentAgent = $this->returnUserAgent();

        $this->attributes['user_id'] = $user_id;
        $this->attributes['ip_address'] = $this->request->getIPAddress();
        $this->attributes['type'] = 'login';
        $this->attributes['user_token'] = $user_token;
        $this->attributes['platform'] = $currentAgent['platform'];
        $this->attributes['user_agent'] = $currentAgent['agent'];
        $this->attributes['is_deleted'] = 0;

        return $user_token;
    }

    /**
     * Used for token randomizer
     */
    protected function rand_string($length) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $size = strlen($chars);
        $token = '';
        for($i = 0; $i < $length; $i++) {
            $str = $chars[rand(0, $size - 1)];
            $token .= $str;
        }
        return $token;
    }

    /**
     * Return device used
     */
    protected function returnUserAgent()
    {
        $agent = $this->request->getUserAgent();
        $currentAgent = array();

        // is it browser? if yes get browser name and version
        if ($agent->isBrowser()) {
            $currentAgent['agent'] = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent['agent'] = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent['agent'] = $agent->getMobile();
        } else {
            $currentAgent['agent'] = 'Unidentified User Agent';
        }
        $currentAgent['platform'] = $agent->getPlatform();

        return $currentAgent;
    }
}