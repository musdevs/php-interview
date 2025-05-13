# PHPWord

## Найти таблицу, в ячейке которой есть искомая строка

```php

	private function findTable(): Table
	{
		$reader = new Word2007();
		$doc = $reader->load($this->templatePath);
		foreach ($doc->getSections() as $section) {
			foreach ($section->getElements() as $element) {
				if ($element instanceof Table) {
					$table = $element;
					foreach ($table->getRows() as $row) {
						foreach ($row->getCells() as $cell) {
							foreach ($cell->getElements() as $element) {
								if ($element instanceof TextRun) {
									foreach ($element->getElements() as $element) {
										if ($element instanceof Text) {
											if ('(из программы)' == $element->getText()) {
												return $table;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

```
