# Documentation for fields as part of the tj library

## Inputbox with character counter (textcounter)
This fields is an extension to a normal input field that shows a counter below the input box that can show the character length. If a maxlength is specified for the inputbox, the field can also display remaining characters. This field adds a new `countertext` attribute where you can specify the text that shows the counter. It's possible to use 3 replacement tokens which will dynamically be replaced with the right values when the field loads. The text and values load in a span element with a unique id so it's possible to style it independently.

*Usage*
```xml
		<field name="name"
			type="textcounter"
			countertext="Characters Used {used} / {maxlength} (Remaining {remaining})"
			maxlength="100"
			required="true"
			size="120"
			filter="safehtml"
			label="COM_EXAMPLE_NAME_LABEL"
			description="COM_EXAMPLE_NAME_DESCRIPTION"
			hint=""
			class="" />
```

## Textarea with character counter (textareacounter)
Similar to textcounter, but for textarea fields.

*Usage*
```xml
		<field name="description"
			type="textareacounter"
			countertext="Characters remaining {remaining} / {maxlength}"
			maxlength="500"
			required="true"
			filter="safehtml"
			label="COM_EXAMPLE_DESCRIPTION_LABEL"
			description="COM_EXAMPLE_DESCRIPTION_DESCRIPTION"
			hint=""
			class="" />
```
