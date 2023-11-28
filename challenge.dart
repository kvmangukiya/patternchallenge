import 'dart:io';

void main() {
  int r, c, line, pno;

  stdout.write("\nEnter number : ");
  line = int.parse(stdin.readLineSync()!);

  for (r = 1; r <= line; r++) {
    pno = 1;
    for (c = 1; c < r; c++) {
      stdout.write("-   ");
      pno = pno + c + 1;
    }
    for (c = r; c <= line; c++) {
      stdout.write("$pno");
      space(pno);
      pno = pno + c;
    }
    for (c = line - 1; c >= r; c--) {
      stdout.write("$pno");
      space(pno);
      pno = pno + c;
    }
    print("");
  }
}

void space(int pno) {
  if (pno < 10) {
    stdout.write("   ");
  } else {
    if (pno < 100) {
      stdout.write("  ");
    } else {
      stdout.write(" ");
    }
  }
}
