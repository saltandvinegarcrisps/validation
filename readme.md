Input validation

	$validation = new Validation\Validation;

	$input = filter_input_array(INPUT_POST, [
		'name' => FILTER_SANTIZE_STRING,
	]);

	// simple
	$rules = [
		'name' => ['required']
	];

	// extended
	$rules = [
		'name' => [
			'label' => 'Your Name',
			'messages' => 'My custom error message for "%s"',
			'rules' => ['required'],
		],
	];

	$validator = validation->create($input, $rules);

	if( ! $validator->isValid()) {
		var_dump($validator->getMessages());
	}
