<?php
namespace Algo_06;


class SingleLinkedListNode {
	/**
	 * 单链表节点数据
	 * @var null
	 */
	public $data;

	/**
	 * 单链表指针
	 * @var null
	 */
	public $next;


	/**
	 * @DateTime    2020-01-08
	 * @Author      Miracle-
	 * @description [description]
	 * @param       [type]        $data [description]
	 * @return      [type]              [description]
	 */
	public function __constuct($data = null) {
		$this->data = $data;
		$this->next = null;
	}
}



?>
