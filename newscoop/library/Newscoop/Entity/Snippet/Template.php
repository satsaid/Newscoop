<?php
/**
 * @package Newscoop
 * @copyright 2014 Sourcefabric o.p.s.
 * @author Yorick Terweijden <yorick.terweijden@sourcefabric.org>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\Entity\Snippet;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Snippet Template entity
 * @ORM\Entity
 * @ORM\Table(name="SnippetTemplates")
 */
class Template
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="Id", type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="Name", type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="Template", type="text")
     * @var text
     */
    private $template;

    /**
     * Getter for id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Setter for id
     *
     * @param int $id
     *
     * @return Newscoop\Entity\Snippet\Template
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Setter for name
     *
     * @param string $name
     *
     * @return Newscoop\Entity\Snippet\Template
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }
    
    /**
     * Getter for template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * Setter for template
     *
     * @param string $template
     *
     * @return Newscoop\Entity\Snippet\Template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }
    
}