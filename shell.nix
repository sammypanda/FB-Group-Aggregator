with (import <nixpkgs> {});

mkShell {
  buildInputs = [
    php81
    php81Packages.composer
    insomnia
  ];
}