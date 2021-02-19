<x-forms::field-group
    :column-span="$field->columnSpan"
    :error-key="$field->name"
    :for="$field->id"
    :help-message="__($field->helpMessage)"
    :hint="__($field->hint)"
    :label="__($field->label)"
    :required="$field->required"
>
    <x-forms::date-time-picker
        :autofocus="$field->autofocus"
        :disabled="$field->disabled"
        :display-format="convert_date_format($field->displayFormat)->to('day.js')"
        :error-key="$field->name"
        :extra-attributes="$field->extraAttributes"
        :format="convert_date_format($field->format)->to('day.js')"
        :id="$field->id"
        :max-date="$field->maxDate"
        :min-date="$field->minDate"
        :name="$field->name"
        :name-attribute="$field->nameAttribute"
        :placeholder="__($field->placeholder)"
        :required="$field->required"
        :time="true"
        :without-seconds="$field->withoutSeconds"
    />
</x-forms::field-group>
