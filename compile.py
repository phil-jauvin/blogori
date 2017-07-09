import os
import json

partials_dir = "templates/partials/"
compiled_dir = "templates/partials-compiled/"

partials = os.listdir(partials_dir)
compiled = os.listdir(compiled_dir)

for partial in compiled:
	os.remove(compiled_dir+partial)

for partial in partials:
	f = open(partials_dir+partial, "r")
	markup = f.read()
	#markup = markup.replace('"', '\\"')
	markup = json.dumps(markup)
	jsonstr= '{"template":'+markup+'}'
	partial = partial.replace(".html", ".json")
	new = open(compiled_dir+partial, "w+")
	new.write(jsonstr)
	new.flush()
	new.close()
	f.close()





