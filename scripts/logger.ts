import chalk from "chalk";
import { EOL } from "os";
import "server-cli-only";
import util from "util";

export const logger = {
  error(...args: unknown[]) {
    logger.inline.error(args);
    logger.inline.newline();
  },
  warn(...args: unknown[]) {
    logger.inline.warn(args);
    logger.inline.newline();
  },
  info(...args: unknown[]) {
    logger.inline.info(args);
    logger.inline.newline();
  },
  debug(...args: unknown[]) {
    logger.inline.debug(args);
    logger.inline.newline();
  },
  success(...args: unknown[]) {
    logger.inline.success(args);
    logger.inline.newline();
  },

  /**
   * Base methods that print to stdio/stderr without line endings.
   * You generally wouldn't use these and would use the public
   * methods above instead.
   */
  inline: {
    error(...args: unknown[]) {
      stderr(chalk.red(...args));
    },
    warn(...args: unknown[]) {
      stdout(chalk.yellow(...args));
    },
    info(...args: unknown[]) {
      stdout(chalk.cyan(...args));
    },
    debug(...args: unknown[]) {
      stdout(chalk.white(...args));
    },
    success(...args: unknown[]) {
      stdout(chalk.green(...args));
    },
    newline() {
      stdout(EOL);
    },
  },

  /**
   * Dumps a literal stringification of the given values.
   * @deprecated Shouldn't be used in production.
   */
  inspect(...args: unknown[]) {
    logger.debug(...args.map((arg) => JSON.stringify(arg, null, 2)));
  },
};

/**
 * Based on `Console.prototype.log` but without the newline.
 */
function stdout(...message: unknown[]) {
  process.stdout.write(util.format.apply(stdout, message));
}

/**
 * Based on `Console.prototype.log` but without the newline.
 */
function stderr(...message: unknown[]) {
  process.stderr.write(util.format.apply(stdout, message));
}
