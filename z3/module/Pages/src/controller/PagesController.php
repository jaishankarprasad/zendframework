<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pages\Controller;


use Pages\Form\RegisterForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\MVC\MvcEvent;
use Zend\Db\Adapter\Adapter;
use Zend\Mvc\Controller\PluginManager;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\Controller\Plugin\redirect;
use Zend\Mvc\Controller\Plugin\Url;



class PagesController extends AbstractActionController
{
	private $adapter;
	private $sql;
	public function __construct()
	{
		$config=[
			'driver'=>'mysqli',
			'database'=>'z3db',
			'username'=>'root',
			'password'=>'',
		];
		$adapter   = new Adapter($config);
		$this->sql = new Sql($adapter);


	}
  

	public function pageAction()
	{
		// $config=[
		// 	'driver'=>'mysqli',
		// 	'database'=>'z3db',
		// 	'username'=>'root',
		// 	'password'=>'',
		// ];
		// $adapter = new Adapter($config);

		
		// $result=$adapter->query("select * from users_tbl",Adapter::QUERY_MODE_EXECUTE);


		//$sql=new Sql($adapter);
		$select=$this->sql->select();
		$select->from('users_tbl');
		$statement=$this->sql->prepareStatementForSqlObject($select);
		$results=$statement->execute();
		$resultSet=new ResultSet;
		$result=$resultSet->initialize($results);


		

		return new ViewModel(['result'=>$result]);

	}


	public function addAction(){
		if($this->getRequest()->isPost()){
			$params=[
				'name'=>$this->getRequest()->getPost('name'),
				'email'=>$this->getRequest()->getPost('email'),
				'mobile'=>$this->getRequest()->getPost('mobile'),
			];
	// 		$config=[
	// 		'driver'=>'mysqli',
	// 		'database'=>'z3db',
	// 		'username'=>'root',
	// 		'password'=>'',
	// 	];
	// 	$adapter = new Adapter($config);
	// 	$insert=$adapter->query("INSERT INTO USERS_TBL(name,email,mobile) VALUES('$params[name]','$params[email]','$params[mobile]')",Adapter::QUERY_MODE_PREPARE);

	// 		$result=$insert->execute($params);
			$insert=$this->sql->insert('users_tbl');
			//$insert->into('users_tbl');
			$insert->values($params);
			$statement=$this->sql->prepareStatementForSqlObject($insert);
			$results=$statement->execute();
		    //$result=$insert->execute();





			if($results->getAffectedRows()>0){
				$this->flashmessenger()->addMessage("Record Inserted Sucessfully");

				//echo "record inserted sucessfully ";
				return $this->redirect()->toRoute('page');


			}
			else{
					//echo "already exits";
				$this->flashmessenger()->addMessage("Record  not Inserted ");
					return $this->redirect()->toRoute('add');
				 }

		}

		$form=new RegisterForm;
		return new ViewModel(['form'=>$form]);
	}


	public function updateAction(){
	 $params =['id'=> $this->params("id"),];
	 // 			//print_r($params);
	// 			//echo $params['id'];
    //     	//exit;
	
		if($this->getRequest()->isPost()){

			$parameters=[
				'name'=>$this->getRequest()->getPost('name'),
				'email'=>$this->getRequest()->getPost('email'),
				'mobile'=>$this->getRequest()->getPost('mobile'),
				'id'=>$this->params('id'),
			];
			$update=$this->sql->update('users_tbl');
			$update->set($parameters);
			$update->where($params);
			$statement=$this->sql->prepareStatementForSqlObject($update);
			$results=$statement->execute();
		// 	$config=[
		// 	'driver'=>'mysqli',
		// 	'database'=>'z3db',
		// 	'username'=>'root',
		// 	'password'=>'',
		// ];
		// $adapter = new Adapter($config);
			// $name = $parameters['name'];
			// $email = $parameters['email'];
			// $mobile = $parameters['mobile'];
			// $prepare=$adapter->query('UPDATE users_tbl SET name=?,email=?,mobile=? WHERE id=?');

			// $update=$prepare->execute($parameters);	
            if($results->getAffectedRows()>0)
            {
            	$this->flashmessenger()->addMessage("Record  Updated  Sucessfully ");
				//echo "record updated successfully ";
				return $this->redirect()->toRoute('page');
			}else{
				echo "error";
			}

		}
		
		
		// $prepare=$adapter->query("SELECT * FROM users_tbl WHERE id=".$params['id']);
		// $result=$prepare->execute();
		// $result=$result->current();
		//print_r($result);
		$select=$this->sql->select();
		$select->from('users_tbl');
		$select->where($params);
		$statement=$this->sql->prepareStatementForSqlObject($select);
		$results=$statement->execute();
		$result=$results->current();




		$form=new RegisterForm;
		return new ViewModel(['form'=>$form,'row'=>$result]);


	}





     public function deleteAction(){
     	 $params =['id'=> $this->params("id"),];

 //     	$config=[
	// 		'driver'=>'mysqli',
	// 		'database'=>'z3db',
	// 		'username'=>'root',
	// 		'password'=>'',
	// 	];
	// 	$adapter = new Adapter($config);
 //     	$prepare=$adapter->query("DELETE FROM users_tbl WHERE id=".$params);
 //     	//echo "hii";
 //     	//print_r($prepare);
 //     	//exit;
 //     	$delete=$prepare->execute();
 //     	if($delete->getAffectedRows()>0){
 //     		echo "record deleted sucessfully ";
 //     	} else{
 //     		echo "error";
 //     	}

 //     	// echo "<a href='/page'> return to page </a>";
 //     	exit;
     	$delete=$this->sql->delete('users_tbl');
     	$delete->where($params);
     	$statement=$this->sql->prepareStatementForSqlObject($delete);
		$deleted=$statement->execute();
		if($deleted->getAffectedRows()>0)
            {
            	$this->flashmessenger()->addMessage("Record  Deleted sucessfully ");
				//echo "record updated successfully ";
				return $this->redirect()->toRoute('page');
			}else{
				echo "error";
			}

     


    }




	public function onDispatch(MvcEvent $arg)
	{
		$response=parent::onDispatch($arg);
		$this->layout()->setTemplate('layout/pageslayout');
		return $response;
	}
}
?>