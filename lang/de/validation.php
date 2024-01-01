<?php

return [

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

    'accepted' => ':attribute muss angenommen werden.',
    'accepted_if' => ':attribute muss angenommen werden wenn :other :value ist.',
    'active_url' => ' :attribute ist keine valide Adresse.',
    'after' => ' :attribute muss nach :date liegen.',
    'after_or_equal' => ' :attribute muss ein Datum nach oder gleich :date sein.',
    'alpha' => ' :attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Binde- und Unterstriche enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => ' :attribute muss ein Array sein.',
    'before' => ' :attribute muss vor :date liegen.',
    'before_or_equal' => ' :attribute muss ein Datum vor oder gleich :date sein.',
    'between' => [
        'array' => ' :attribute muss zwischen :min und :max Einträge enthalten.',
        'file' => ' :attribute muss zwischen :min und :max KB sein.',
        'numeric' => ' :attribute muss eine Zahl zwischen :min und :max sein.',
        'string' => ' :attribute muss zwischen :min und :max Zeichen enthalten.',
    ],
    'boolean' => ' :attribute muss WAHR oder FALSCH sein.',
    'city' => 'Ortsangabe fehlt',
    'code' => 'Postleitzahl fehlt',
    'confirmed' => ' :attribute stimmt nicht überein.',
    'current_password' => 'Passwort ist nicht korrekt.',
    'date' => ' :attribute muss ein gültiges Datum sein.',
    'date_equals' => ' :attribute muss ein Datum wie :date sein.',
    'date_format' => ' :attribute hat nicht die Form :format.',
    'declined' => ' :attribute muss abgelehnt werden.',
    'declined_if' => ' :attribute muss abgelehnt werden wenn :other :value ist.',
    'different' => ' :attribute und :other müssen verschieden sein.',
    'districtID' => 'bitte das Startgebiet festlegen',
    'digits' => ' :attribute darf nur aus :digits Ziffern bestehen.',
    'digits_between' => ' :attribute muss zwischen :min und :max Ziffern sein.',
    'dimensions' => ' :attribute has keine zulässigen Maße.',
    'distinct' => ' :attribute besitzt ein Duplikat.',
    'email' => ' :attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => ' :attribute muss mit einem der Werte enden: :values.',
    'enum' => ' :attribute ist nicht erlaubt.',
    'exists' => ' :attribute ist nicht erlaubt.',
    'file' => ' :attribute muss eine Datei sein.',
    'filled' => ' :attribute muss angegeben sein.',
    'gt' => [
        'array' => ' :attribute muss mehr als :value Einträge enthalten.',
        'file' => ' :attribute muss größer als :value kilobytes sein.',
        'numeric' => ' :attribute muss größer als :value sein.',
        'string' => ' :attribute muss mehr als :value Zeichen enthalten.',
    ],
    'gte' => [
        'array' => ' :attribute muss mindestens :value enthalten.',
        'file' => ' :attribute muss mindestens :value kilobytes sein.',
        'numeric' => ' :attribute muss mindestens :value sein.',
        'string' => ' :attribute muss mindestens :value Zeichen enthalten.',
    ],
    'image' => ' :attribute muss ein Bild sein.',
    'in' => ' Auswahl :attribute ist nicht erlaubt.',
    'in_array' => 'Eintrag :attribute existiert nicht in :or.',
    'integer' => ' :attribute muss eine ganze Zahl sein.',
    'ip' => ' :attribute muss eine gültige IP Adresse sein.',
    'ipv4' => ' :attribute muss eine gültige IPv4 Adresse sein.',
    'ipv6' => ' :attribute muss eine gültige IPv6 Adresse sein.',
    'json' => ' :attribute muss eine gültige JSON Formatierung sein.',
    'lt' => [
        'array' => ' :attribute muss weniger als :value Einträge enthalten.',
        'file' => ' :attribute muss kleiner :value kilobytes sein.',
        'numeric' => ' :attribute muss kleiner :value sein.',
        'string' => ' :attribute muss weniger als :value Zeichen enthalten.',
    ],
    'lte' => [
        'array' => ' :attribute darf maximal :value Einträge enthalten.',
        'file' => ' :attribute darf maximal :value kilobytes sein.',
        'numeric' => ' :attribute darf maximal gleich :value sein.',
        'string' => ' :attribute darf maximal :value Zeichen enthalten.',
    ],
    'mac_address' => ' :attribute muss eine gültige MAC Addresse sein.',
    'max' => [
        'array' => ' :attribute darf nicht mehr als :max Einträge enthalten.',
        'file' => ' :attribute darf nicht größer :max kilobytes sein.',
        'numeric' => ' :attribute darf nicht größer :max sein.',
        'string' => ' :attribute darf nicht mehr als :max Zeichen enthalten.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => ' :attribute muss eine Datei vom Typ :values sein.',
    'min' => [
        'array' => ' :attribute muss mindestens :min Einträge enthalten.',
        'file' => ' :attribute muss mindestens :min kilobytes sein.',
        'numeric' => ' :attribute muss mindestens :min sein.',
        'string' => ' :attribute muss mindestens :min Zeichen enthalten.',
    ],
    'multiple_of' => ' :attribute muss ein Vielfaches von :value sein.',
    'not_in' => ' Auswahl :attribute ist nicht erlaubt.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ' :attribute muss numerisch sein.',
    'password' => 'Passwort ist nicht korrekt.',
    'present' => ' :attribute muss vorhanden sein.',
    'prohibited' => ' :attribute ist nicht gestattet.',
    'prohibited_if' => ' :attribute ist nicht gestattet wenn :other  :value ist.',
    'prohibited_unless' => ' :attribute ist nicht gestattet wenn nicht  :other Teil von :values ist.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ' :attribute ist ein Pflichtfeld.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'salutationID' => 'Die Anrede muss festgelegt werden',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'street' => 'Straße &amp; Hausnummer müssen angegeben werden',
    'string' => ' :attribute muss eine Zeichenkette sein.',
    'timezone' => ' :attribute muss eine gültige Zeitzone sein.',
    'unique' => ' :attribute ist bereits vergeben.',
    'uploaded' => ' :attribute konnte nicht hochgeladen werden.',
    'url' => ' :attribute muss ein gültiger URL sein.',
    'uuid' => ' :attribute muss eine gültige UUID sein.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'author'                      => 'Autor',
        'germanName'                  => 'Deutscher Artname',
        'scientificName'              => 'Wissenschaftlicher Name',
        'orderID'                     => 'Ordnung',
        'subOrderID'                  => 'Unterordnung',
        'familyID'                    => 'Familie',
        'subFamilyID'                 => 'Unterfamilie',
    ]
];
