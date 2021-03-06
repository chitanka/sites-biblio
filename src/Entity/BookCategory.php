<?php namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="App\Repository\BookCategoryRepository")
 * @ORM\Table
 */
class BookCategory extends Entity {

	/**
	 * @var string
	 * @ORM\Column(type="string", length=60)
	 */
	private $name;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=60)
	 */
	private $slug;

	/**
	 * @Gedmo\TreeLeft
	 * @ORM\Column(name="lft", type="integer")
	 */
	private $lft;

	/**
	 * @Gedmo\TreeLevel
	 * @ORM\Column(name="lvl", type="integer")
	 */
	private $lvl;

	/**
	 * @Gedmo\TreeRight
	 * @ORM\Column(name="rgt", type="integer")
	 */
	private $rgt;

	/**
	 * @Gedmo\TreeRoot
	 * @ORM\ManyToOne(targetEntity="BookCategory")
	 * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $root;

	/**
	 * @Gedmo\TreeParent
	 * @ORM\ManyToOne(targetEntity="BookCategory")
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $parent;

	/**
	 * Number of books in this category
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	private $nrOfBooks = 0;

	public function __toString() {
		$indent = str_repeat('·', $this->lvl * 10) . ' ';
		return $indent . $this->getName();
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setSlug($slug) {
		$this->slug = $slug;
	}

	public function getSlug() {
		return $this->slug;
	}

	public function getRoot() {
		return $this->root;
	}

	public function setParent(BookCategory $parent = null) {
		$this->parent = $parent;
	}

	public function getParent() {
		return $this->parent;
	}

	public function setNrOfBooks($nrOfBooks) {
		$this->nrOfBooks = $nrOfBooks;
	}

	public function getNrOfBooks() {
		return $this->nrOfBooks;
	}

	public function toArray() {
		return [
			'name' => $this->name,
			'slug' => $this->slug,
			'parent' => $this->getParent(),
			'nrOfBooks' => $this->nrOfBooks,
			'treeLevel' => $this->lvl,
			'treeLeft' => $this->lft,
			'treeRight' => $this->rgt,
		];
	}
}
