<?php

declare(strict_types=1);

namespace GiacomoMasseroni\PHPCleanArchitecture;

final readonly class Application
{
    private string $baseFolder;

    public function __construct()
    {
        if (file_exists('.src/')) {
            $this->baseFolder = 'src';
        } else {
            $this->baseFolder = 'app';
        }
    }

    /**
     * @param list<string> $argv
     */
    public function run(array $argv): int
    {
        $command = $this->mapCommand($argv);
        $arguments = $this->getArguments($argv);

        switch ($command) {
            case 'install':
                $this->install($arguments);
                exit(0);

            case 'check':
                $output = [];
                $result = $this->check($arguments, $output);
                echo implode(PHP_EOL, $output);
                exit($result);

                /*case 'create:use-case':
                    $this->createUseCase($arguments);
                    exit(0);*/
        }

        exit(1);
    }

    /**
     * @param list<string> $argv
     */
    private function mapCommand(array $argv): string
    {
        return $argv[1] ?? '';
    }

    /**
     * @param list<string> $argv
     * @return list<string>
     */
    private function getArguments(array $argv): array
    {
        return array_map(function (string $arg) {
            return str_replace('-', '', $arg);
        }, array_slice($argv, 2));
    }

    /**
     * @param list<string> $arguments
     */
    private function install(array $arguments): void
    {
        echo "Installing PHP Clean Architecture...\n";

        $newPath = '.' . DIRECTORY_SEPARATOR . 'deptrac.yaml';

        if (file_exists($newPath)) {
            if (! $this->readYesNo()) {
                echo "Operation cancelled. deptrac.yaml file was not overwritten.\n";
                return;
            }
        }

        echo "Copying deptrac.yaml file to your root directory.\n";

        $this->copyDeptracFile($newPath);

        echo "Done! You can now run 'vendor/bin/php-clean-architecture check' to check your architecture.\n";
    }

    /**
     * @param list<string> $arguments
     * @param list<mixed> $output
     * @return int
     */
    private function check(array $arguments, array &$output): int
    {
        exec('vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'deptrac' . (in_array('v', $arguments) ? ' -v' : ''), $output, $resultCode);
        return $resultCode;
    }

    /*private function createUseCase(array $arguments): void
    {
        if (empty($arguments[0])) {
            echo "Error: specify use case name.\n";
            return;
        }

        $useCaseName = $arguments[0];
        $directory = $this->baseFolder . DIRECTORY_SEPARATOR . 'UseCases';
        $filePath = $directory . DIRECTORY_SEPARATOR . $useCaseName . '.php';

        if (!is_dir($directory)) {
            mkdir($directory, 0o777, true);
        }

        if (file_exists($filePath)) {
            echo "Error: file '$filePath' already exists.\n";
            return;
        }

        $stubContent = file_get_contents($this->getBasePath() . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'use-case.stub');

        if ($stubContent !== false) {
            $content = str_replace(
                [
                    '{{namespace}}',
                    '{{useCaseName}}',
                ],
                [
                    'App\UseCases',
                    $useCaseName,
                ],
                $stubContent
            );
            file_put_contents($filePath, $content);

            echo "Use case created: $filePath\n";
        }
    }*/

    private function copyDeptracFile(string $newPath): void
    {
        $this->updateDeptracPath($this->baseFolder, $newPath);
    }

    private function updateDeptracPath(string $deptracPath, string $newPath): void
    {
        $filePath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'deptrac.yaml';
        $content = file_get_contents($filePath);
        if ($content !== false) {
            $newContent = str_replace('{deptrac_path}', $deptracPath, $content);
            file_put_contents($newPath, $newContent);
        }
    }

    private function readYesNo(): bool
    {
        while (true) {
            $input = strtolower(trim((string) readline("A deptrac.yaml file already exists. Do you want to overwrite it? (y/n): ")));

            if ($input === 'y' || $input === 'n') {
                return $input === 'y';
            }

            echo "Invalid input. Please enter 'y' or 'n'.\n";
        }
    }

    private function getBasePath(): string
    {
        return '.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'giacomomasseron' . DIRECTORY_SEPARATOR . 'php-clean-architecture';
    }
}
