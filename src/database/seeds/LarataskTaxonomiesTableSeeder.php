<?php

namespace Stylers\Laratask\Datatabase\Seeds;

use Illuminate\Database\Seeder;
use Stylers\Taxonomy\Models\Language;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\TaxonomyTranslation;

class LarataskTaxonomiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kpiNames = Taxonomy::loadTaxonomy(config('laratask.taxonomy.task_template_names'));
        $kpiNames->name = 'task_template_names';
        $kpiNames->save();

        $taxonomies = [
            'laratask.taxonomy.task_status' => 'laratask.taxonomy.task_statuses',
        ];

        $this->loadTaxonomies($taxonomies);
    }

//    TODO
    public function loadTaxonomies(array $loadList)
    {
        foreach ($loadList as $parent => $child) {
            $this->createTaxonomyWithChild($parent, $child);
        }
    }

    public function createTaxonomyWithChild(string $parent, string $child)
    {
        $array = explode('.', $parent);

        $parentTx = Taxonomy::loadTaxonomy(config($parent));
        $parentTx->name = end($array);
        $parentTx->save();

        $config = config($child);
        foreach ($config as $name => $data) {
            $tx = Taxonomy::loadTaxonomy($data['id']);
            $tx->name = $name;
            $tx->priority = isset($data['priority']) ?: null;
            $tx->save();
            $tx->makeChildOf($parentTx);

            if (!empty($data['translations'])) {
                foreach ($data['translations'] as $lang_code => $tr_name) {
                    $language = Language::getByCode($lang_code);
                    $tr = new TaxonomyTranslation();
                    $tr->language_id = $language->id;
                    $tr->taxonomy_id = $tx->id;
                    $tr->name = $tr_name;
                    $tr->save();
                }
            }
        }
    }
}