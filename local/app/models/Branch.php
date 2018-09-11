<?php

class Branch extends \Eloquent {

	protected $fillable = [];
    protected $table    =   'branch';
    protected $guarded  = ['id'];

    public static $rules = [
        'designationID' => 'required',
        "branch.0"=>'required',
   ];
    public static function rules($id=false,$merge=[])
	{
		$rules = self::$rules;
		if ($id) {
			foreach ($rules as &$rule) {
				$rule = str_replace(':id', $id, $rule);
			}
		}
		return array_merge( $rules, $merge );
	}
    protected function designation()
    {
        return $this->belongsTo('Designation','designationID','id');
    }
}