<?php 
namespace Snaptec\RestApiExample\Model;
 
 
class PostManagement {

	/**
	 * {@inheritdoc}
	 */
	public function getPostManager($param)
	{
		return 'api GET return the $param ' . $param;
	}
}