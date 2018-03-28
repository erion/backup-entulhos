unit UdmFiscalizacao;

interface

uses
  SysUtils, Classes, DB, ADODB, Wwdatsrc, DBTables, Wwquery, Messages;

type
  TdmFiscalizacao = class(TDataModule)
    dbPmnh: TADOConnection;
    qryDenuncia: TADOQuery;
    dsDenuncia: TwwDataSource;
    qryLogin: TADOQuery;
    qry: TADOQuery;
    qryLoginidusuario: TIntegerField;
    qryLogincodlotacao: TStringField;
    qryLoginnome: TStringField;
    qryLoginlogin: TStringField;
    qryLoginsenha: TStringField;
    qryLoginmatricula: TStringField;
    qryDenunciadatahoradenuncia: TDateTimeField;
    qryDenunciaassunto: TStringField;
    qryDenunciarequerente: TStringField;
    qryDenunciainfrator: TStringField;
    qryDenunciaidinfrator: TIntegerField;
    qryDenunciadescricao: TStringField;
    qryDenunciaiddenuncia: TIntegerField;
    qryDenunciaidsolicitacao: TIntegerField;
    procedure tbSolicitacaoAfterInsert(DataSet: TDataSet);
    procedure tbSolicitacaoAfterCancel(DataSet: TDataSet);
    procedure tbSolicitacaoBeforePost(DataSet: TDataSet);
    procedure tbDenunciaBeforePost(DataSet: TDataSet);
  private
    { Private declarations }

  public
    { Public declarations }

    function getValorCodigo(campo:string): integer;

  end;

var
  dmFiscalizacao: TdmFiscalizacao;

implementation


{$R *.dfm}

function TdmFiscalizacao.getValorCodigo(campo:string): integer;
begin
{
  With qryValoresChave do
  begin
    Close;
    Parameters.ParamByName('campo').Value:=campo;
    Open;
    Last;
    Edit;
    Fieldbyname('valor').Value:= Fieldbyname('valor').Value + 1;
    Post;
  end;
  Result := qryValoresChave.fieldbyname('valor').Value + 1;
}
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterInsert(DataSet: TDataSet);
begin
//  tbSolicitacaoidusuario.Value := qryLoginidusuario.Value;
end;

procedure TdmFiscalizacao.tbSolicitacaoAfterCancel(DataSet: TDataSet);
begin
//  frmSolicitacao.Close;
end;

procedure TdmFiscalizacao.tbSolicitacaoBeforePost(DataSet: TDataSet);
begin
{
  if dsSolicitacao.State in [dsinsert] then
    tbSolicitacaoidSolicitacao.AsInteger := getValorCodigo('idsolicitacao');
}
end;

procedure TdmFiscalizacao.tbDenunciaBeforePost(DataSet: TDataSet);
begin
{
  if dsCaddenuncia.State in [dsinsert] then
    tbDenunciaiddenuncia.AsInteger := getValorCodigo('iddenuncia');
  tbDenunciaidsituacao.AsInteger := 1;
}  
end;

end.
