Input validation

	$input = filter_input_array(INPUT_POST, [
		'name' => FILTER_SANTIZE_STRING,
	]);

	// simple
	$rules = [
		'name' => ['required'],
	];

	// extended
	$rules = [
		'name' => [
			'label' => 'Your Name',
			// field name is used if no label is set in message
			'message' => 'My custom error message for "%s"',
			'rules' => ['required'],
		],
	];

	$validator = \Validation\ValidatorFactory::create($input, $rules);

	if( ! $validator->isValid()) {
		var_dump($validator->getMessages());
	}
