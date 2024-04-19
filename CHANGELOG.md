# Changelog

All notable changes to this project will be documented in this file.

## [0.2.2] - 2024-08-19
### Added
- `Expr::case` now can receive an expression as a parameter to allow `CASE <expr> WHEN ...` instead of just `CASE WHEN ...`

## [0.2.1] - 2023-08-29
### Fixed
- Added missing version number from CHANGELOG.md

## [0.2.0] - 2023-08-29
### Added
- `ConverterRegistry::register` to register new type converter.
- `ConvertibleTypeInterface` to be implemented by objects to get their type converted when used as a query value.
- `EnumConverter` to convert any enum into query values. The `->value` property is used with `BackedEnum` while the `->name` property is used with any other enum.
- 100+ MySQL functions implementation in `Func`
### Changed
- `ChainConverter` to `ConverterRegistry`
### Removed
- PHP < 7.4 compatibility.
- Ability to use `ASC` or `DESC` as `orderBy` keys by doing `$qb->orderBy(['DESC' => <some-query-expression>])`. 
  - This behavior was limited and confusing.
  - The same can be achieved by using `$qb->addOrderBy(<some-query-expression>, 'DESC')`.

## [0.1.4] - 2022-09-28
### Added
- PHP 8+ compatibility.

## [0.1.3] - 2021-08-27
### Fixed
- PHP version compatibility being too high.

## [0.1.2] - 2020-11-25
### Fixed
- Some documentation errors.

## [0.1.1] - 2020-11-25
### Fixed
- Some documentation errors.

## [0.1.0] - 2020-11-25
### Added
- The whole project.