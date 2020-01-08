<?php
namespace Algo_06;

class SingleLinkedList {

	/**
	 * 单链表头结点（哨兵节点）
	 * @var [type]
	 */
	public $head;

	/**
	 * 单链表长度
	 * @var [type]
	 */
	private $length;

	/**
	 * @DateTime    2020-01-08
	 * @Author      Miracle-
	 * @description 初始化单链表
	 * @param       null     $head
	 */
	public function __construct($head = null) {
		if (null == $head) {
			$this->head = new SingleLinkedListNode();
		} else {
			$this->head = $head;
		}

		$this->length = 0;
	}

	/**
	 * @DateTime    2020-01-08
	 * @Author      Miracle-
	 * @description 获取单链表长度
	 * @return      int
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * 插入数据 采用头插法 插入新数据
	 *
	 * @return      SingleLinkedListNode|bool
	 */
	public function insert($data) {
		return $this->insertDataAfter($this->head, $data);
	}

	/**
	 * @description 删除节点
	 * @param       SingleLinkedListNode $node [description]
	 * @return      bool                     [description]
	 */
	public function delete(SingleLinkedListNode $node) {
		if (null == $node) {
			return false;
		}

		// 获取待删除节点的前置节点
		$preNode = $this->getPreNode($node);
		if (empty($preNode)) {
			return false;
		}

		// 修改指针指向
		$preNode->next = $node->next;
		unset($node);

		$this->length--;
		return true;
	}

	/**
	 * @description 按照索引获取单链表节点
	 * @param       int        $index 索引
	 * @return      SingleLinkedListNode|bool
	 */
	public function getNodeByIndex($index) {
		if (null == $index) {
			return false;
		}

		$cur = $this->head->next;
		for ($i=0; $i < $index; ++$i) {
			$cur = $cur->next;
		}

		return $cur;
	}

	/**
	 * @description 获取前置节点
	 * @param       SingleLinkedListNode $node
	 * @return      SingleLinkedListNode|bool
	 */
	public function getPreNode(SingleLinkedListNode $node)
	{
		if (null == $node) {
			return false;
		}

		$curNode = $this->head;
		$preNode = $this->head;
		// 遍历找到前置节点 要用全等判断是否是同一个对象
		while ($curNode !== $node) {
			if (null == $curNode) {
				return null;
			}
			$preNode = $curNode;
			$curNode = $curNode->next;
		}

		return $preNode;
	}

	/**
	 * @description 输出单链表 当data的数据为可输出类型
	 * @return      bool
	 */
	public function printList()
	{
		if (null == $this->head->next) {
			return false;
		}

		$curNode = $this->head;
		// 防止链表带环，控制遍历次数
		$listLength = $this->getLength();
		while($curNode->next != null && $listLength--) {
			echo $curNode->next->data . ' -> ';

			$curNode = $curNode->next;
		}
		echo 'Null' . PHP_EOL;

		return true;
	}

	/**
	 * @description 在节点后插入数据
	 * @param       SingleLinkedListNode $originNode
	 * @param                      $data
	 * @return      SingleLinkedListNode|bool
	 */
	public function insertDataAfter(SingleLinkedListNode $originNode, $data)
	{
		if (null == $originNode) {
			return false;
		}

		// 新建单链表节点
		$newNode = new SingleLinkedListNode($data);

		// 新的节点下一个节点为原节点下一个节点
		$newNode->next = $originNode->next;
		$originNode->next = $newNode;

		$this->length++;

		return $newNode;
	}

	/**
	 * @description 在节点前插入数据
	 * @param       SingleLinkedListNode $originNode 原节点
	 * @param                      $data
	 * @return      SingleLinkedListNode
	 */
	public function insertDataBefore(SingleLinkedListNode $originNode, $data)
	{
		if ($originNode == null) {
			return false;
		}

		$preNode = $this->getPreNode($originNode);

		return $this->insertDataAfter($preNode, $data);
	}

	public function insertNodeAfter(SingleLinkedListNode $originNode, SingleLinkedListNode $node)
	{
		if (null == $originNode) {
			return false;
		}

		$node->next = $originNode->next->next;
		$originNode->next = $node;

		$this->length++;

		return $node;
	}

	public function buildHasCircleList()
	{
		$data = [1, 2, 3, 4, 5, 6, 7, 8];
        $node0 = new SingleLinkedListNode($data[0]);
        $node1 = new SingleLinkedListNode($data[1]);
        $node2 = new SingleLinkedListNode($data[2]);
        $node3 = new SingleLinkedListNode($data[3]);
        $node4 = new SingleLinkedListNode($data[4]);
        $node5 = new SingleLinkedListNode($data[5]);
        $node6 = new SingleLinkedListNode($data[6]);
        $node7 = new SingleLinkedListNode($data[7]);
        $this->insertNodeAfter($this->head, $node0);
        $this->insertNodeAfter($node0, $node1);
        $this->insertNodeAfter($node1, $node2);
        $this->insertNodeAfter($node2, $node3);
        $this->insertNodeAfter($node3, $node4);
        $this->insertNodeAfter($node4, $node5);
        $this->insertNodeAfter($node5, $node6);
        $this->insertNodeAfter($node6, $node7);
        $node7->next = $node4;
	}
}
