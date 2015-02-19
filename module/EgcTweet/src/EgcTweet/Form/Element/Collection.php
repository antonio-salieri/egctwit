<?php
namespace EgcTweet\Form\Element;

use Zend\Form\Element\Collection as ZendFormElementCollection;
use Zend\Form\Exception\DomainException;
use Zend\Form\FieldsetInterface;

class Collection extends ZendFormElementCollection
{
    public function populateValues($data)
    {
        if (! is_array($data) && ! $data instanceof Traversable) {
            throw new Exception\InvalidArgumentException(sprintf('%s expects an array or Traversable set of data; received "%s"', __METHOD__, (is_object($data) ? get_class($data) : gettype($data))));
        }
        
        // Can't do anything with empty data
        if (empty($data)) {
            return;
        }
        
        if (! $this->allowRemove && count($data) < $this->count) {
            throw new Exception\DomainException(sprintf('There are fewer elements than specified in the collection (%s). Either set the allow_remove option ' . 'to true, or re-submit the form.', get_class($this)));
        }
        
        // Check to see if elements have been replaced or removed
        foreach ($this->byName as $name => $elementOrFieldset) {
            if (isset($data[$name])) {
                continue;
            }
            
            if (! $this->allowRemove) {
                throw new Exception\DomainException(sprintf('Elements have been removed from the collection (%s) but the allow_remove option is not true.', get_class($this)));
            }
            
            $this->remove($name);
        }
        
        for ($key = 0; $key < $this->count; $key ++) {
            if ($this->has($key)) {
                $elementOrFieldset = $this->get($key);
            } else {
                $elementOrFieldset = $this->addNewTargetElementInstance($key);
                
                if ($key > $this->lastChildIndex) {
                    $this->lastChildIndex = $key;
                }
            }
            
            if (empty($data))
                continue;
            
            $value = array_shift($data);
            
            
            if ($elementOrFieldset instanceof FieldsetInterface) {
                $elementOrFieldset->populateValues($value);
            } else {
                $elementOrFieldset->setAttribute('value', $value);
            }
        }
        
        if (! $this->createNewObjects()) {
            $this->replaceTemplateObjects();
        }
    }
}
