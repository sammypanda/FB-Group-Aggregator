with (import <nixpkgs> {});

mkShell {
  buildInputs = [
    php83
    php83Packages.composer
    insomnia
  ];
}