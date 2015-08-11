==Visual Output Tests==
There currently seem to be binary differences in the creation of a pdf which makes comparison tricky. My guess for differences include platform differences on fonts and rendering.

In these tests I compare a downloaded version of the example pdfs downloaded from http://www.tcpdf.org/ July 2015 (tests/_expected_pdfs) with the output created in the tests. ImageMagick is used to convert the pdf pages to images and then compute the differences between the images.

There are obviously limitations to this approach (only visual output is compared and an artificially selected threshold of what is the same vs what is different = not pixel perfect). Any suggestions for improvements are welcome.
