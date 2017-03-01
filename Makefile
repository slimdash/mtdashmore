APPNAME=importaz

all: dist

clean: 
	@mkdir -p dist
	@rm -rf dist/*

dist: clean
	tar --exclude='./config/config.ini' --exclude='./${APPNAME}.tar.gz' --exclude="./tmp/*/*.*" --exclude='./dist/' \
	--exclude=".git/" --exclude=".phpintel/" --exclude=".DS_Store" --exclude="./tests/" \
	-zcvf dist/${APPNAME}.tar.gz .
