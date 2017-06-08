<?php namespace MspPack\DDSAdmin\Repositories;

use MspPack\DDSAdmin\Setting;
use MspPack\DDSAdmin\Helpers\EloquentHelper;
use DB;

class SettingRepo
{
	public function getBy($params = array())
	{
		$query = DB::table('settings');

        $query->select(array(
            'settings.*',
        ));

        $EloquentHelper = new EloquentHelper();
        return $EloquentHelper->allInOne($query, $params);
	}

	/**
	 * update setting
	 *
	 * @param  array  $data
	 * @return setting
	 */
	public function update(array $data,$id)
	{
		return Setting::where('id', '=', $id)->update($data);
	}

	/**
	 * create setting
	 *
	 * @param  array  $data
	 * @return setting
	 */
	public function create(array $data)
	{
		return Setting::create($data);
	}
	/**
	* get list of interest and skill
	*
	* @param  array  $data
	* @return User
	*/
	public function lists($colom='interest')
	{
		$data = Setting::first();

		if (!empty($data->{$colom})) {
			$list = explode(',', $data->{$colom});
			return array_combine($list,$list);
		}
		return array();
	}
}