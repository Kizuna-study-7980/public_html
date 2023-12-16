import sys
import Util

argvs = sys.argv
program_name = argvs[0]
graduation_year = Util.getGraduationYear(1)

if len(argvs) >= 2:
    imput = argvs[1]
    print("Hello" + " " + imput + " getGraduationYear(1):" + str(graduation_year))
    print("Hello", imput, " getGraduationYear(1):", graduation_year)
else:
    print("Hello")
