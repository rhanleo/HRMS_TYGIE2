<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => " :attribute qəbul edilməlidir.",
	"active_url"           => " :attribute URL düzgün deyil.",
	"after"                => " :attribute tarix növbəti :date tarixdən sonra olmalıdır.",
	"alpha"                => " :attribute yalnız hərflərdən ibarət olmalıdır.",
	"alpha_dash"           => " :attribute yalnız hərflərdən və rəqəmlərdən ibarət olmalıdır.",
	"alpha_num"            => " :attribute yalnız hərflərdən və rəqəmlərdən ibarət olmalıdır.",
	"array"                => " :attribute sıra ilə olmalıdır.",
	"before"               => " :attribute tarixi :date tarixindən əvvəl olmalıdır.",
	"between"              => array(
		"numeric" => " :attribute :min və :max aralığında olmalıdır.",
		"file"    => " :attribute :min və :max kilobayt aralığında olmalıdır.",
		"string"  => " :attribute :min və :max simvol aralığında olmalıdır.",
		"array"   => " :attribute :min və :max ədəd aralığında olmalıdır.",
	),
	"boolean"              => " :attribute açıq və ya deaktiv olmalıdır.",
	"confirmed"            => " :attribute təsdiqi uyğun deyil.",
	"date"                 => " :attribute düzgün tarix deyil.",
	"date_format"          => " :attribute :format formatına uyğun deyil.",
	"different"            => " :attribute və :other fərqli olmalıdır.",
	"digits"               => " :attribute :digits rəqəm olmalıdır.",
	"digits_between"       => " :attribute :min və :max rəqəm aralığında olmalıdır.",
	"email"                => " :attribute email ünvanı düzgün olmalıdır.",
	"exists"               => " seçilmiş :attribute səhvdir.",
	"image"                => " :attribute şəkil olmalıdır.",
	"in"                   => " seçilmiş :attribute səhvdir.",
	"integer"              => " :attribute tam olmalıdır.",
	"ip"                   => " :attribute dügün İP olmalıdır.",
	"max"                  => array(
		"numeric" => " :attribute :max böyük olmamalıdır.",
		"file"    => " :attribute :max kilobaytdan çox olmamalıdır.",
		"string"  => " :attribute :max simvoldan çox olmamalıdır.",
		"array"   => " :attribute :max ədəddən çox olmamalıdır.",
	),
	"mimes"                => " :attribute dəstəklənən fayl formatlarından olmalıdır. Dəstəklənən formatlar: :values.",
	"min"                  => array(
		"numeric" => " :attribute :min çox olmalıdır.",
		"file"    => " :attribute :min kilobaytdan çox olmalıdır.",
		"string"  => " :attribute :min simvoldan çox olmalıdır.",
		"array"   => " :attribute :min ədəddən çox olmalıdır.",
	),
	"not_in"               => " seçilmiş :attribute səhvdir.",
	"numeric"              => " :attribute rəqəmlərdən ibarət olmalıdır.",
	"regex"                => " :attribute formatı səhvdir.",
	"required"             => " :attribute xanasını doldurmaq vacibdir.",
	"required_if"          => " :attribute xanasını doldurmaq vacibdir.",
	"required_with"        => " :attribute xanasını doldurmaq vacibdir.",
	"required_with_all"    => " :attribute xanasını doldurmaq vacibdir.",
	"required_without"     => " :attribute xanasını doldurmaq vacibdir.",
	"required_without_all" => " :attribute xanasını doldurmaq vacibdir.",
	"same"                 => " :attribute və :other uyğun olmalıdır.",
	"size"                 => array(
		"numeric" => " :attribute :size olmalıdır.",
		"file"    => " :attribute :size kilobbayt olmalıdır.",
		"string"  => " :attribute :size simvol olmalıdır.",
		"array"   => " :attribute :size ədəd olmalıdır.",
	),
	"unique"               => " :attribute artıq istifadə edilir.",
	"url"                  => " :attribute formatı səhvdir.",
	"timezone"             => " :attribute dügün saat qurşağı olmalıdır.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
