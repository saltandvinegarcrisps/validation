## Validator

Symfony like array validation

    $validator = new Validation\ArrayValidator();

    $validator->addConstraint('first_name', new Validation\Assert\Length(['min' => 3]));

    $validator->addConstraint('last_name', new Validation\Assert\Present());

    $violations = $validator->validate(['first_name' => 'me']);

    echo $violations->count(); // 1
    echo count($violations); // 1

    print_r($violations->getMessages());

    Array
    (
        [first_name] => Array
            (
                [0] => first name must be greater than or equal to 3 characters
            )

        [last_name] => Array
            (
                [0] => last name must be present
            )
    )
