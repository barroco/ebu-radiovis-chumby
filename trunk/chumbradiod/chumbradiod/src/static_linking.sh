#!/bin/sh

arm-linux-g++  -g -O2  -L/home/mc/crad/lib -o chumbradiod  chumbradiod.o crad_interface.o crad_return_codes.o crad_content_handler.o crad_crossdomain_handler.o qndriver.o qnio.o crad_rds_decoder.o -lpthread -lasound /home/mc/crad/lib/libchumbhttpd.a

