$sq = $db->query("SELECT `url_title`,`ID`,`id_article`,`created_date` FROM `article` WHERE `id_article`>3893");
											//$db->query("UPDATE `arts` SET `state`='Published'");
											//$db->query("UPDATE `arts` SET `briefing`=`title`");
								
								if($sq->count()){
									$arr =array();
									foreach($sq->results() as $articl_data){
										if(!in_array($articl_data->id_article,$arr)){
											$arr[] = $articl_data->id_article;
										}else{
											// $db->query("DELETE FROM `articles` WHERE `id` = '{$articl_data->id}'");
											// $db->delete('articles',array('id','=',$articl_data->id));
										}
										
										//$articleCategClass = new ArticleCateg();
										
										// $articleCategClass->remove_article($articl_data->ID);
										// $articleCategClass->insert(array(
											// 'article_ID' => $articl_data->ID,
											// 'category_ID' => '3',
											// 'created_date' => $articl_data->created_date
										// ));
										
										//echo strtotime($articl_data->created_date).'<br>';
										//echo 'yeah'.'<br>';
										
										//$tm_mod = strtotime($articl_data->created_date);
										//$db->query("UPDATE `arts` SET `created_date`='{$tm_mod}' WHERE `id_article` = '{$articl_data->id_article}'");
										
										// $url_title = $articl_data->url_title;
										// $validate = new Validate();
									//	$url_title = $validate->autoUniqueMaker('article','url_title',$url_title);
										
										//$db->query("UPDATE `arts` SET `url_title`='{$url_title}' WHERE `id_article` = '{$articl_data->id_article}'");
										
									}
								}
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								