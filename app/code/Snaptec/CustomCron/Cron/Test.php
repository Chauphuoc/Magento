<?php

namespace Snaptec\CustomCron\Cron;


class Test
{
    /**
     * @return $this
     * $throws \Zend_Log_Exception
     */
	public function execute()
	{
        date_default_timezone_set('Asia/Kolkata');
        $timezone = date_default_timezone_get();
        $date = date('d/m/Y h:i:s',time());

		$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/cron.log');
		$logger = new \Zend_Log();
		$logger->addWriter($writer);
		$logger->info('my custom cron job excuted at ' .$date . " " .$timezone);

		return $this;

	}
}
