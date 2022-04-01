<?php

abstract class AbstractFactory{
    abstract public function getDBConnection() : DBConnection;
    abstract public function getDBRecrord() : DBRecrord;
    abstract public function getDBQueryBuiler() : DBQueryBuiler;
}


class MySQLFactory extends AbstractFactory{
    public function getDBConnection() : DBConnection{
        return new MySQLDBConnection();
    }

    public function getDBRecrord() : DBRecrord{
        return new MySQLDBRecrord();
    }

    public function getDBQueryBuiler() : DBQueryBuiler{
        return new MySQLDBQueryBuiler();
    }
}

class PostgreSQLFactory extends AbstractFactory{
    public function getDBConnection() : DBConnection{
        return new PostgreSQLDBConnection();
    }

    public function getDBRecrord() : DBRecrord{
        return new PostgreSQLDBRecrord();
    }

    public function getDBQueryBuiler() : DBQueryBuiler{
        return new PostgreSQLDBQueryBuiler();
    }
}

class OracleFactory extends AbstractFactory{
    public function getDBConnection(): DBConnection{
        return new OracleDBConnection();
    }

    public function getDBRecrord(): DBRecrord{
        return new OracleDBRecrord();
    }

    public function getDBQueryBuiler(): DBQueryBuiler{
        return new OracleDBQueryBuiler();
    }
}



interface DBConnection{
    public function usefulFunctionDBConnection() : string;
}

class MySQLDBConnection implements DBConnection{
    public function usefulFunctionDBConnection(): string{
        return "MySQLDBConnection";
    }
}

class PostgreSQLDBConnection implements DBConnection{
    public function usefulFunctionDBConnection(): string{
        return "PostgreSQLDBConnection";
    }
}

class OracleDBConnection implements DBConnection{
    public function usefulFunctionDBConnection(): string{
        return "OracleDBConnection";
    }
}



interface DBRecrord{
    public function usefulFunctionDBRecrord() : string;
}

class MySQLDBRecrord implements DBRecrord{
    public function usefulFunctionDBRecrord(): string{
        return "MySQLDBRecrord";
    }
}

class PostgreSQLDBRecrord implements DBRecrord{
    public function usefulFunctionDBRecrord(): string{
        return "PostgreSQLDBRecrord";
    }
}

class OracleDBRecrord implements DBRecrord{
    public function usefulFunctionDBRecrord(): string{
        return "OracleDBRecrord";
    }
}



interface DBQueryBuiler{
    public function usefulFunctionDBQueryBuiler() : string;
}

class MySQLDBQueryBuiler implements DBQueryBuiler{
    public function usefulFunctionDBQueryBuiler(): string{
        return "MySQLDBQueryBuiler";
    }
}

class PostgreSQLDBQueryBuiler implements DBQueryBuiler{
    public function usefulFunctionDBQueryBuiler(): string{
        return "PostgreSQLDBQueryBuiler";
    }
}

class OracleDBQueryBuiler implements DBQueryBuiler{
    public function usefulFunctionDBQueryBuiler(): string{
        return "OracleDBQueryBuiler";
    }
}



function clientCode(AbstractFactory $factory){
    $dbConnect = $factory->getDBConnection();
    $dbRecrord = $factory->getDBRecrord();
    $dbQueryBuiler = $factory->getDBQueryBuiler();

    echo $dbConnect->usefulFunctionDBConnection() . "<br>";
    echo $dbRecrord->usefulFunctionDBRecrord() . "<br>";
    echo $dbQueryBuiler->usefulFunctionDBQueryBuiler() . "<br>";
    echo "<hr>";
}

clientCode(new MySQLFactory());
clientCode(new PostgreSQLFactory());
clientCode(new OracleFactory());
