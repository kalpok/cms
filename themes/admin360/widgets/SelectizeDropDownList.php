<?php
namespace core\widgets;

class SelectizeDropDownList extends \dosamigos\selectize\SelectizeDropDownList
{
    public $allItems;
    public $valueField;
    public $labelField;
    public $searchField;
    public $selectedItems;
    public $additionalItems;

    public function init()
    {
        parent::init();
        $this->clientOptions = [
            'options' => $this->makeReadyForSelectize(),
            'items' =>
                is_array($this->selectedItems) ?
                $this->selectedItems : [$this->selectedItems],
            'valueField' => $this->valueField,
            'labelField' => $this->labelField,
            'searchField' => is_array($this->searchField) ?
                $this->searchField : [$this->searchField],
        ];
    }

    private function makeReadyForSelectize()
    {
        $items = [];
        $value = $this->valueField;
        $label = $this->labelField;
        foreach ($this->allItems as $item) {
            $items[] = [
                $label => $item->$label,
                $value => $item->$value
            ];
        }
        if (!empty($this->additionalItems)) {
            $items = array_merge($this->additionalItems, $items);
        }
        return $items;
    }

}
?>

