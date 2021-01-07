<?php


namespace Resto2web\Menu\Admin\Meals\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Meals\Models\MealOption;
use Resto2web\Menu\Domain\Meals\Models\MealOptionGroup;

class MealOptionsComponent extends Component
{
    public Meal $meal;
    public string $option_group_name = '';
    public string $option_group_type = 'or';
    public string $option_group_required = "true";
    public array $mealOptions = [];
    public array $names = [];
    public array $mealOptionGroups = [];
    public array $editNames = [];


    public function mount()
    {
        $this->buildArray();
    }

    public function updated($item,$value)
    {
        if (explode('.',$item)[0] == 'mealOptions') {
            if (explode('.',$item)[2] == 'price') {
                MealOption::findOrFail(explode('.',$item)[1])->update([
                    explode('.',$item)[2] => (float) ($value ?? 0)
                ]);
            }else {
                MealOption::findOrFail(explode('.', $item)[1])->update([
                    explode('.', $item)[2] => $value
                ]);
            }
        }
        if (explode('.',$item)[0] == 'names') {

            MealOptionGroup::findOrFail(explode('.',$item)[1])->update([
                'name' => $value
            ]);
        }
        if (explode('.',$item)[0] == 'mealOptionGroups') {
            if (explode('.',$item)[2] == 'required') {
                MealOptionGroup::findOrFail(explode('.',$item)[1])->update([
                    explode('.',$item)[2] => (bool) $value
                ]);
            }else{
                MealOptionGroup::findOrFail(explode('.',$item)[1])->update([
                    explode('.',$item)[2] => $value
                ]);
            }
        }

    }

    public function render()
    {
        return view('resto2web-admin::components.meal-options-component');
    }

    public function addOptionGroup()
    {
        $this->validate([
            'option_group_name' => 'required',
            'option_group_type' => 'required',
        ]);
        MealOptionGroup::create([
            'meal_id' => $this->meal->id,
            'name' => $this->option_group_name,
            'type' => $this->option_group_type,
            'required' => $this->option_group_required == true ,
        ]);
        $this->meal->refresh();
        $this->emit('closeModal');
        $this->buildArray();
        $this->option_group_name = '';
    }

    public function addOption($optionGroupId)
    {
        MealOption::create([
            'meal_option_group_id' => $optionGroupId,
            'name' => '',
            'price' => 0.0
        ]);
        $this->meal->refresh();
        $this->buildArray();

    }

    public function deleteOption($optionId)
    {
        MealOption::findOrFail($optionId)->delete();
        $this->meal->refresh();
    }

    public function deleteOptionGroup($optionGroupId)
    {
        $group = MealOptionGroup::findOrFail($optionGroupId);
        foreach ($group->mealOptions as $option) {
            $option->delete();
        }
        $group->delete();
        $this->meal->refresh();
        $this->buildArray();
    }

    public function editName($id)
    {
        $this->editNames[$id] = true;
    }

    public function buildArray(): void
    {
        foreach ($this->meal->optionsGroups as $group) {
            $this->mealOptionGroups[$group->id]['required'] = $group->required;
            $this->mealOptionGroups[$group->id]['type'] = $group->type;
            $this->names[$group->id] = $group->name;
            foreach ($group->mealOptions as $mealOption) {
                $this->mealOptions[$mealOption->id]['name'] = $mealOption->name;
                $this->mealOptions[$mealOption->id]['price'] = $mealOption->price;
            }
        }
    }


}
