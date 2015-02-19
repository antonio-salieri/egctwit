<?php
namespace EgcTweet\Service;

use ZendService\Twitter\Twitter as ZendTwitter;

class Twitter extends ZendTwitter
{
	const DEFAULT_LIST_SIZE = 10;

	public function __construct($options = null, OAuth\Consumer $consumer = null, Http\Client $httpClient = null)
	{
		parent::__construct($options, $consumer, $httpClient);

		// Fix broken ZF2 HTTP Client
		if (isset($options['http_client_options']) &&
			isset($options['http_client_options']['adapter']))
		{
			$adapter_config = array();
			if (isset($options['http_client_options']['adapter_options']))
			{
				$adapter_config = $options['http_client_options']['adapter_options'];
			}
    		$client_addapter = new $options['http_client_options']['adapter']($adapter_config);

    		$this->getHttpClient()->setAdapter($client_addapter);
		}
	}

	public function usersSearch($query, array $options = array())
	{
        if(!isset($options['count']))
        {
        	$options['count'] = self::DEFAULT_LIST_SIZE;
        }

        return parent::usersSearch($query, $options);
	}
}
