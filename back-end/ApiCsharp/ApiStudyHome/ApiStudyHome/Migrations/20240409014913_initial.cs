using System;
using Microsoft.EntityFrameworkCore.Migrations;
using Npgsql.EntityFrameworkCore.PostgreSQL.Metadata;

#nullable disable

namespace ApiStudyHome.Migrations
{
    /// <inheritdoc />
    public partial class initial : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "anotacao",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    Descricao = table.Column<string>(type: "text", nullable: false),
                    DataNota = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    IdUsuario = table.Column<int>(type: "integer", nullable: false),
                    TipoUsuario = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_anotacao", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "escola",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    CNPJ = table.Column<string>(type: "text", nullable: false),
                    Email = table.Column<string>(type: "text", nullable: false),
                    Senha = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_escola", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "professor",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    Email = table.Column<string>(type: "text", nullable: false),
                    Senha = table.Column<string>(type: "text", nullable: false),
                    Telefone = table.Column<int>(type: "integer", nullable: false),
                    Ativo = table.Column<bool>(type: "boolean", nullable: false),
                    Cpf = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_professor", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "turma",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_turma", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "materia",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    ProfessorId = table.Column<int>(type: "integer", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_materia", x => x.Id);
                    table.ForeignKey(
                        name: "FK_materia_professor_ProfessorId",
                        column: x => x.ProfessorId,
                        principalTable: "professor",
                        principalColumn: "Id");
                });

            migrationBuilder.CreateTable(
                name: "alunos",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    TurmaId = table.Column<int>(type: "integer", nullable: false),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    Email = table.Column<string>(type: "text", nullable: false),
                    Senha = table.Column<string>(type: "text", nullable: false),
                    Telefone = table.Column<int>(type: "integer", nullable: false),
                    Ativo = table.Column<bool>(type: "boolean", nullable: false),
                    Cpf = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_alunos", x => x.Id);
                    table.ForeignKey(
                        name: "FK_alunos_turma_TurmaId",
                        column: x => x.TurmaId,
                        principalTable: "turma",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "tarefa",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    Descricao = table.Column<string>(type: "text", nullable: false),
                    DataCadastro = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    DataFinal = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    NomeArquivo = table.Column<string>(type: "text", nullable: false),
                    Materia = table.Column<string>(type: "text", nullable: false),
                    Ativo = table.Column<bool>(type: "boolean", nullable: false),
                    ProfessorId = table.Column<int>(type: "integer", nullable: false),
                    TurmaId = table.Column<int>(type: "integer", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_tarefa", x => x.Id);
                    table.ForeignKey(
                        name: "FK_tarefa_professor_ProfessorId",
                        column: x => x.ProfessorId,
                        principalTable: "professor",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_tarefa_turma_TurmaId",
                        column: x => x.TurmaId,
                        principalTable: "turma",
                        principalColumn: "Id");
                });

            migrationBuilder.CreateTable(
                name: "turmaProfessor",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    TurmaId = table.Column<int>(type: "integer", nullable: false),
                    ProfessorId = table.Column<int>(type: "integer", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_turmaProfessor", x => x.Id);
                    table.ForeignKey(
                        name: "FK_turmaProfessor_professor_ProfessorId",
                        column: x => x.ProfessorId,
                        principalTable: "professor",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_turmaProfessor_turma_TurmaId",
                        column: x => x.TurmaId,
                        principalTable: "turma",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "arquivoEntregue",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    Nome = table.Column<string>(type: "text", nullable: false),
                    AlunoId = table.Column<int>(type: "integer", nullable: false),
                    TarefaId = table.Column<int>(type: "integer", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_arquivoEntregue", x => x.Id);
                    table.ForeignKey(
                        name: "FK_arquivoEntregue_alunos_AlunoId",
                        column: x => x.AlunoId,
                        principalTable: "alunos",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_arquivoEntregue_tarefa_TarefaId",
                        column: x => x.TarefaId,
                        principalTable: "tarefa",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateTable(
                name: "entregue",
                columns: table => new
                {
                    Id = table.Column<int>(type: "integer", nullable: false)
                        .Annotation("Npgsql:ValueGenerationStrategy", NpgsqlValueGenerationStrategy.IdentityByDefaultColumn),
                    IdAluno = table.Column<int>(type: "integer", nullable: false),
                    IdTarefa = table.Column<int>(type: "integer", nullable: false),
                    DataEntregue = table.Column<DateTime>(type: "timestamp with time zone", nullable: false),
                    ComentariosProfessor = table.Column<string>(type: "text", nullable: false),
                    ComentariosAluno = table.Column<string>(type: "text", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_entregue", x => x.Id);
                    table.ForeignKey(
                        name: "FK_entregue_alunos_IdAluno",
                        column: x => x.IdAluno,
                        principalTable: "alunos",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_entregue_tarefa_IdTarefa",
                        column: x => x.IdTarefa,
                        principalTable: "tarefa",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_alunos_TurmaId",
                table: "alunos",
                column: "TurmaId");

            migrationBuilder.CreateIndex(
                name: "IX_arquivoEntregue_AlunoId",
                table: "arquivoEntregue",
                column: "AlunoId");

            migrationBuilder.CreateIndex(
                name: "IX_arquivoEntregue_TarefaId",
                table: "arquivoEntregue",
                column: "TarefaId");

            migrationBuilder.CreateIndex(
                name: "IX_entregue_IdAluno",
                table: "entregue",
                column: "IdAluno");

            migrationBuilder.CreateIndex(
                name: "IX_entregue_IdTarefa",
                table: "entregue",
                column: "IdTarefa");

            migrationBuilder.CreateIndex(
                name: "IX_materia_ProfessorId",
                table: "materia",
                column: "ProfessorId");

            migrationBuilder.CreateIndex(
                name: "IX_tarefa_ProfessorId",
                table: "tarefa",
                column: "ProfessorId");

            migrationBuilder.CreateIndex(
                name: "IX_tarefa_TurmaId",
                table: "tarefa",
                column: "TurmaId");

            migrationBuilder.CreateIndex(
                name: "IX_turmaProfessor_ProfessorId",
                table: "turmaProfessor",
                column: "ProfessorId");

            migrationBuilder.CreateIndex(
                name: "IX_turmaProfessor_TurmaId",
                table: "turmaProfessor",
                column: "TurmaId");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "anotacao");

            migrationBuilder.DropTable(
                name: "arquivoEntregue");

            migrationBuilder.DropTable(
                name: "entregue");

            migrationBuilder.DropTable(
                name: "escola");

            migrationBuilder.DropTable(
                name: "materia");

            migrationBuilder.DropTable(
                name: "turmaProfessor");

            migrationBuilder.DropTable(
                name: "alunos");

            migrationBuilder.DropTable(
                name: "tarefa");

            migrationBuilder.DropTable(
                name: "professor");

            migrationBuilder.DropTable(
                name: "turma");
        }
    }
}
