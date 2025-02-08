COMMON_MARK_VERSION ?= 0.31.2

download-spec:
	curl -o tests/spec/spec.json https://spec.commonmark.org/$(COMMON_MARK_VERSION)/spec.json
	curl -o tests/spec/spec.txt https://spec.commonmark.org/$(COMMON_MARK_VERSION)/spec/.txt

.PHONY: download-spec
